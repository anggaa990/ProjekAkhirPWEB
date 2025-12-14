<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
            
            return match ($role) {
                'admin' => redirect()->route('admin.dashboard'),
                'employee' => redirect()->route('employee.dashboard'),
                default => redirect()->route('dashboard'),
            };
        }

        return $next($request);
    }
}