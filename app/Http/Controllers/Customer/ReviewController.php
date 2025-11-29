<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Reservation $reservation)
    {
        // Cek apakah reservasi milik user yang login
        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        // Cek apakah sudah pernah review
        if ($reservation->review) {
            return redirect()->route('customer.reservations.show', $reservation)
                ->with('error', 'Anda sudah memberikan review untuk reservasi ini.');
        }

        // Hanya bisa review jika status completed
        if ($reservation->status !== 'completed') {
            return redirect()->route('customer.reservations.show', $reservation)
                ->with('error', 'Anda hanya bisa memberikan review setelah reservasi selesai.');
        }

        return view('customer.reviews.create', compact('reservation'));
    }

    public function store(Request $request, Reservation $reservation)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        if ($reservation->review) {
            return back()->with('error', 'Anda sudah memberikan review untuk reservasi ini.');
        }

        Review::create([
            'user_id' => auth()->id(),
            'reservation_id' => $reservation->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('customer.reservations.show', $reservation)
            ->with('success', 'Terima kasih atas review Anda!');
    }
}