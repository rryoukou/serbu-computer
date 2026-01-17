<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // validasi input
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'no_hp' => 'nullable',
            'alamat' => 'nullable',
        ]);

        // simpan user baru
        User::create([
            'username' => $request->username,
            'password' => $request->password, // auto hash via cast
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'role' => 'pengguna',
        ]);

        // redirect ke login
        return redirect('/login')
            ->with('success', 'Register berhasil, silakan login');
    }
}
