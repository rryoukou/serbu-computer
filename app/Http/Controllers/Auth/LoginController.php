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
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // 2️⃣ Proses login
        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'username' => 'Username atau password salah',
            ])->withInput();
        }

        // 3️⃣ Regenerasi session
        $request->session()->regenerate();

        // 4️⃣ Redirect SESUAI ROLE (WAJIB)
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // default: pengguna
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
