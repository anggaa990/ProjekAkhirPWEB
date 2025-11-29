<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RoleLoginController extends Controller
{
    public function chooseRole()
    {
        return view('auth.choose-role');
    }

    public function loginForm($role)
    {
        return view('auth.login', compact('role'));
    }

    public function processLogin(Request $request, $role)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)
                    ->where('role', $role)
                    ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Email atau password salah');
        }

        // ✅ LOGIN MENGGUNAKAN AUTH LARAVEL
        Auth::login($user);
        
        // ✅ REGENERATE SESSION (security)
        $request->session()->regenerate();

        // ✅ Simpan role ke session untuk middleware role
        session(['role' => $user->role]);

        // Redirect sesuai role
        return match ($role) {
            'admin'    => redirect()->route('admin.dashboard'),
            'employee' => redirect()->route('employee.dashboard'),
            'customer' => redirect()->route('customer.dashboard'),
            default    => redirect()->route('dashboard'),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('landing');
    }
}