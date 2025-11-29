<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            // Kalau belum login, redirect ke halaman pilih role
            return redirect()->route('choose.role')->with('error', 'Silakan login terlebih dahulu');
        }

        return $next($request);
    }
}