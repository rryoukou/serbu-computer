<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // ambil SEMUA pengguna (bukan admin)
$users = User::where('role', 'pengguna')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        // proteksi admin
        if ($user->role === 'admin') {
            return back()->with('error', 'Admin tidak bisa dihapus');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus');
    }
}
