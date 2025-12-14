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
        $tables = RestaurantTable::where('status', 'available')->get();
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

        // ==========================================================
        // 🚨 LOGIKA PENCEGAHAN TABRAKAN (Double Booking)
        // ==========================================================
        
        $tableId = $request->table_id;
        $date = $request->date;
        $time = $request->time;
        
        // Status yang dianggap "memesan" atau "mengunci" meja
        $activeStatuses = ['pending', 'confirmed']; 
        
        $existingReservation = Reservation::where('table_id', $tableId)
            ->where('date', $date)
            // Memeriksa tabrakan waktu yang tepat
            ->where('time', $time)
            ->whereIn('status', $activeStatuses)
            ->first();

        if ($existingReservation) {
            // Menggunakan Carbon untuk memformat tampilan waktu yang lebih baik
            $formattedDate = \Carbon\Carbon::parse($date)->format('d F Y');
            $formattedTime = \Carbon\Carbon::parse($time)->format('H:i');

            return back()->withInput()->withErrors([
                'table_id' => "Meja ini sudah dipesan pada tanggal {$formattedDate} pukul {$formattedTime}."
            ])->with('error', 'Pemesanan gagal: Meja yang Anda pilih sudah terisi pada waktu tersebut.');
        }

        // ==========================================================
        // LOGIKA TRANSAKSI PEMBUATAN RESERVASI
        // ==========================================================
        
        DB::beginTransaction();
        try {
            // Buat Reservasi
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
                ->with('success', 'Reservasi berhasil dibuat!');

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