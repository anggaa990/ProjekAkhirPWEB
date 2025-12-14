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

    // ✅ METHOD BARU: Untuk menampilkan pilihan login/register customer
    public function customerAuthChoice()
    {
        return view('auth.customer-auth-choice');
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

    // ========== REGISTRASI CUSTOMER ==========
    
    public function registerForm()
    {
        return view('auth.register');
    }

    public function processRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        // Buat user baru dengan role customer
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'role' => 'customer', // Default role customer
        ]);

        // Auto login setelah registrasi
        Auth::login($user);
        
        // Regenerate session (security)
        $request->session()->regenerate();
        
        // Simpan role ke session
        session(['role' => 'customer']);

        return redirect()->route('customer.dashboard')
            ->with('success', 'Registrasi berhasil! Selamat datang di restoran kami.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('landing');
    }
}