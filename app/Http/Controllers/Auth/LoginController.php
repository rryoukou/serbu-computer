<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // 1️⃣ Validasi input
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // 2️⃣ Ambil user dulu berdasarkan username
        $user = \App\Models\User::where('username', $request->username)->first();

        // 3️⃣ Cek apakah user dibanned
        if ($user && $user->is_banned) {
            return back()->withErrors([
                'username' => 'Akun kamu sudah dibanned, silahkan hubungi admin.'
            ])->withInput();
        }

        // 4️⃣ Proses login
        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'username' => 'Username atau password salah'
            ])->withInput();
        }

        // 5️⃣ Regenerasi session
        $request->session()->regenerate();

        $user = auth()->user();

        // 6️⃣ Redirect sesuai role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
