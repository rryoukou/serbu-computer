<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LOGIN PENGGUNA
    |--------------------------------------------------------------------------
    */
    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        // Cek banned
        if ($user && $user->is_banned) {
            return back()->withErrors([
                'username' => 'Akun kamu sudah dibanned, silahkan hubungi admin.'
            ])->withInput();
        }

        // Coba login
        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'username' => 'Username atau password salah'
            ])->withInput();
        }

        $request->session()->regenerate();

        // Pastikan role pengguna
        if (auth()->user()->role !== 'pengguna') {
            Auth::logout();
            return back()->withErrors([
                'username' => 'Login ini khusus pengguna.'
            ]);
        }

        return redirect()->route('dashboard');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN ADMIN
    |--------------------------------------------------------------------------
    */
    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'username' => 'Username atau password salah'
            ])->withInput();
        }

        $request->session()->regenerate();

        // Pastikan role admin
        if (auth()->user()->role !== 'admin') {
            Auth::logout();
            return back()->withErrors([
                'username' => 'Login ini khusus admin.'
            ]);
        }

        return redirect()->route('admin.dashboard');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}