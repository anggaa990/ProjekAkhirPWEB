<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Lihat semua reservasi
    public function index()
    {
        $reservations = Reservation::with(['user', 'table'])->latest()->get();
        return view('employee.reservations.index', compact('reservations'));
    }

    // Detail reservasi
    public function show(Reservation $reservation)
    {
        $reservation->load(['user', 'table']);
        return view('employee.reservations.show', compact('reservation'));
    }

    // Update status reservasi (Approve/Reject/Complete)
    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:confirmed,cancelled,completed',
        ]);

        $reservation->update(['status' => $request->status]);

        // Status confirmed → meja jadi reserved
        if ($request->status === 'confirmed' && $reservation->table_id) {
            RestaurantTable::find($reservation->table_id)
                ->update(['status' => 'reserved']);
        }

        // Status cancelled → meja available
        if ($request->status === 'cancelled' && $reservation->table_id) {
            RestaurantTable::find($reservation->table_id)
                ->update(['status' => 'available']);
        }

        // Status completed → meja available lagi
        if ($request->status === 'completed' && $reservation->table_id) {
            RestaurantTable::find($reservation->table_id)
                ->update(['status' => 'available']);
        }

        return redirect()->back()->with('success', 'Status reservasi berhasil diperbarui!');
    }

    // Mark reservasi sebagai completed (jika kamu pakai route khusus)
    public function complete(Reservation $reservation)
    {
        $reservation->update(['status' => 'completed']);

        if ($reservation->table_id) {
            RestaurantTable::find($reservation->table_id)
                ->update(['status' => 'available']);
        }

        return redirect()->back()->with('success', 'Reservasi ditandai selesai!');
    }
}
