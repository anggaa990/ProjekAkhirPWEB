<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (session('role') !== $role) {
            return redirect('/')->with('error', 'Akses ditolak.');
        }

        return $next($request);
    }
}
