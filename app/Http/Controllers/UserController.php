<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // tampilkan halaman edit profil
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    // update data profil
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'no_hp' => 'nullable',
            'alamat' => 'nullable',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'email' => $request->email,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        // update password kalau diisi
        if ($request->password) {
            $user->password = $request->password; // auto hash
            $user->save();
        }

        return back()->with('success', 'Profil berhasil diperbarui');
    }

    // upload foto profil
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = Auth::user();

        $filename = time() . '.' . $request->foto->extension();
        $request->foto->storeAs('public/foto', $filename);

        $user->foto = $filename;
        $user->save();

        return back()->with('success', 'Foto profil berhasil diupload');
    }
}
