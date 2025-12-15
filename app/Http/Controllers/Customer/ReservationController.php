<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\RestaurantTable;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::where('user_id', auth()->id())
            ->with(['table', 'orders.items.menu', 'review']) 
            ->latest()
            ->get();
        
        return view('customer.reservations.index', compact('reservations'));
    }

    public function create()
    {
        $activeStatuses = ['pending', 'confirmed']; 
        $now = Carbon::now();
        $nowDatetimeString = $now->format('Y-m-d H:i:s');
        
        $tables = RestaurantTable::all()->map(function($table) use ($activeStatuses, $nowDatetimeString) {
            
            // Perubahan Kunci: Menggunakan ->get() untuk mengambil SEMUA reservasi aktif yang akan datang.
            // Membandingkan gabungan kolom date dan time dengan waktu saat ini.
            $upcomingReservations = $table->reservations()
                ->whereIn('status', $activeStatuses)
                ->whereRaw("date || ' ' || time > ?", [$nowDatetimeString])
                ->orderBy('date', 'asc')
                ->orderBy('time', 'asc') 
                ->get(); 

            // Menyimpan koleksi semua reservasi yang akan datang
            $table->upcomingReservations = $upcomingReservations; 
            
            // Menyimpan reservasi terdekat sebagai referensi cepat (elemen pertama dari koleksi)
            $table->nextReservation = $upcomingReservations->first(); 

            return $table;
        });

        $menus = Menu::where('is_available', true)->where('stock', '>', 0)->get();
        
        return view('customer.reservations.create', compact('tables', 'menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:restaurant_tables,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'people' => 'required|integer|min:1',
            'notes' => 'nullable|string',
            'menu_items' => 'nullable|array',
            'menu_items.*.menu_id' => 'required|exists:menus,id',
            'menu_items.*.quantity' => 'required|integer|min:1',
        ]);

        $tableId = $request->table_id;
        $date = $request->date;
        $time = $request->time;
        
        $reservationTime = Carbon::parse("{$date} {$time}");
        $durationMinutes = 90;
        
        // Pengecekan dimulai 90 menit sebelum waktu reservasi dan berakhir 90 menit sesudahnya (total bentrokan 3 jam)
        $checkStartTime = $reservationTime->copy()->subMinutes($durationMinutes);
        $checkEndTime = $reservationTime->copy()->addMinutes($durationMinutes);

        $activeStatuses = ['pending', 'confirmed']; 
        
        $existingReservation = Reservation::where('table_id', $tableId)
            ->whereIn('status', $activeStatuses)
            ->where(function ($query) use ($checkStartTime, $checkEndTime) {
                // Menggunakan whereRaw dengan operator || untuk menggabungkan DATE dan TIME, 
                // ini diperlukan untuk SQLite (standar Laravel)
                $query->whereRaw("date || ' ' || time BETWEEN ? AND ?", 
                    [
                        $checkStartTime->format('Y-m-d H:i:s'), 
                        $checkEndTime->format('Y-m-d H:i:s')
                    ]);
            })
            ->first();

        if ($existingReservation) {
            $formattedDate = Carbon::parse($date)->format('d F Y');
            $existingTime = Carbon::parse($existingReservation->time)->format('H:i');
            $requestTime = Carbon::parse($time)->format('H:i');
            
            return back()->withInput()->withErrors([
                'table_id' => "Meja ini sudah dipesan pada tanggal {$formattedDate}. Terdapat reservasi aktif pukul {$existingTime} yang bentrok dengan waktu yang Anda minta ({$requestTime})."
            ])->with('error', 'Pemesanan gagal: Meja yang Anda pilih sudah terisi pada waktu yang berdekatan.');
        }
        
        DB::beginTransaction();
        try {
            $reservation = Reservation::create([
                'user_id' => auth()->id(),
                'table_id' => $request->table_id,
                'date' => $request->date,
                'time' => $request->time,
                'people' => $request->people,
                'status' => 'pending',
                'notes' => $request->notes,
            ]);

            if ($request->has('menu_items') && count($request->menu_items) > 0) {
                $total = 0;
                
                $order = Order::create([
                    'user_id' => auth()->id(),
                    'reservation_id' => $reservation->id,
                    'status' => 'pending',
                    'total' => 0,
                ]);

                foreach ($request->menu_items as $item) {
                    $menu = Menu::findOrFail($item['menu_id']);
                    
                    if ($menu->stock < $item['quantity']) {
                         throw new \Exception("Stok menu {$menu->name} tidak mencukupi ({$menu->stock} tersisa).");
                    }
                    
                    OrderItem::create([
                        'order_id' => $order->id,
                        'menu_id' => $menu->id,
                        'quantity' => $item['quantity'],
                        'price' => $menu->price,
                    ]);

                    $total += $menu->price * $item['quantity'];
                }

                $order->update(['total' => $total]);
            }

            DB::commit();
            return redirect()->route('customer.reservations.index')
                ->with('success', 'Reservasi berhasil dibuat! Menunggu konfirmasi dari karyawan.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Reservation $reservation)
    {
        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        $reservation->load(['table', 'orders.items.menu', 'review']);
        return view('customer.reservations.show', compact('reservation'));
    }
}