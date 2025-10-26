<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // === Halaman Login ===
    public function showLogin()
    {
        return view('login');
    }

    // === Proses Login ===
public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        
        // Redirect sesuai role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'user') {
            return redirect()->route('pesan'); // <-- redirect ke pesan
        }
    }

    return back()->with('error', 'Email atau password salah.');
}


    // === Halaman Register ===
    public function showRegister()
    {
        return view('register');
    }

    // === Proses Register ===
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // default user biasa
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    // === Logout ===
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
