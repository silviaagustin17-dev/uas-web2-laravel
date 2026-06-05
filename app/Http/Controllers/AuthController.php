<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLogin() {
        return view('auth.login');
    }

    // Proses validasi saat tombol login diklik
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Sukses login langsung lempar ke halaman event kamu yang dulu
            return redirect()->route('event.index'); 
        }

        return back()->withErrors([
            'loginError' => 'Email atau password salah!',
        ]);
    }

    // Proses logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}