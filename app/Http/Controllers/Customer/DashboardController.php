<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Statistik Reservasi
        $totalReservations = Reservation::where('user_id', $user->id)->count();
        $activeReservations = Reservation::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->count();
        $completedReservations = Reservation::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();
        
        // Rating Data - Ambil semua review dari semua customer
        $totalReviews = Review::count();
        
        // Hitung rata-rata rating
        $averageRating = $totalReviews > 0 ? Review::avg('rating') : 0;
        
        // Distribusi rating (berapa banyak rating 1, 2, 3, 4, 5)
        $ratingDistribution = Review::select('rating', DB::raw('count(*) as count'))
            ->groupBy('rating')
            ->pluck('count', 'rating')
            ->toArray();
        
        // Review terbaru (3 terakhir)
        $recentReviews = Review::with('user')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        
        return view('customer.dashboard', compact(
            'totalReservations',
            'activeReservations', 
            'completedReservations',
            'averageRating',
            'totalReviews',
            'ratingDistribution',
            'recentReviews'
        ));
    }
}