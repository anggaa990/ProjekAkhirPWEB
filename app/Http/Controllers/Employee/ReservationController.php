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

        $oldStatus = $reservation->status;
        
        // Update status reservasi
        $reservation->update(['status' => $request->status]);

        if ($reservation->table_id) {
            $table = RestaurantTable::find($reservation->table_id);
            
            if ($table) {
                if ($request->status === 'confirmed') {
                    $table->update(['status' => 'reserved']);
                }
                
                // Status cancelled atau completed → meja available
                if (in_array($request->status, ['cancelled', 'completed'])) {
                    if ($table->status === 'reserved') {
                        $table->update(['status' => 'available']);
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Status reservasi berhasil diperbarui!');
    }

    // Mark reservasi sebagai completed
    public function complete(Reservation $reservation)
    {
        $reservation->update(['status' => 'completed']);

        if ($reservation->table_id) {
            $table = RestaurantTable::find($reservation->table_id);
            if ($table && $table->status === 'reserved') {
                $table->update(['status' => 'available']);
            }
        }

        return redirect()->back()->with('success', 'Reservasi ditandai selesai!');
    }
}