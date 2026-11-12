<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Memproses data login
    // Memproses data login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'], // Ubah dari ['required', 'username'] menjadi ['required']
            'password' => ['required'],
        ], [
            'username.required' => 'Kolom username wajib diisi!',
            'password.required' => 'Kolom password wajib diisi!',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/posts')->with('success', 'Berhasil masuk ke Dashboard Admin!');
        }

        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ])->onlyInput('username');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah keluar.');
    }
}