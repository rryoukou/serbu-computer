<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Tampilkan semua user (dengan search + pagination)
     * Hanya menampilkan pengguna, admin tidak muncul
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $perPage = $request->get('per_page', 5); 

        $users = User::where('role', 'pengguna')
    ->when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('username', 'like', "%{$search}%")
              ->orWhere('nama', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    })
    ->latest()
    ->paginate($perPage)
    ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Banned / Unbanned user
     */
    public function toggleBan(User $user)
    {
        // ❌ Cegah banned untuk akun admin
        if ($user->role === 'admin') {
            return back()->withErrors([
                'banned' => 'Admin tidak bisa dibanned.'
            ]);
        }

        // ✅ Toggle status is_banned
        $user->update([
            'is_banned' => !$user->is_banned
        ]);

        $statusText = $user->is_banned ? 'dibanned' : 'aktif';
        return back()->with('success', "User berhasil diubah statusnya menjadi: $statusText.");
    }

    /**
     * Hapus user (opsional)
     */
    public function destroy(User $user)
    {
        if ($user->role === 'admin') {
            return back()->withErrors([
                'delete' => 'Admin tidak bisa dihapus.'
            ]);
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }
}
