<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nama' => 'required',
            'password' => 'nullable|confirmed|min:6',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // upload foto
        if ($request->hasFile('foto')) {

            if ($user->foto && Storage::disk('public')->exists('foto/'.$user->foto)) {
                Storage::disk('public')->delete('foto/'.$user->foto);
            }

            $filename = time().'_'.$request->foto->getClientOriginalName();
            $request->foto->storeAs('foto', $filename, 'public');
            $user->foto = $filename;
        }

        // update password kalau diisi
        if ($request->filled('password')) {
            $user->password = $request->password; // auto hash
        }

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}
