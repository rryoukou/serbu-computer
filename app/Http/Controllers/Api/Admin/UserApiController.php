<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserApiController extends Controller
{
    /**
     * ================================
     * LIST USER (API)
     * ================================
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
            ->paginate($perPage);

        return response()->json([
            'status' => true,
            'message' => 'List user',
            'data' => $users
        ]);
    }

    /**
     * ================================
     * TOGGLE BAN USER (API)
     * ================================
     */
    public function toggleBan(User $user)
    {
        if ($user->role === 'admin') {
            return response()->json([
                'status' => false,
                'message' => 'Admin tidak bisa dibanned.'
            ], 400);
        }

        $user->update([
            'is_banned' => !$user->is_banned
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Status user berhasil diubah',
            'data' => $user
        ]);
    }

    /**
     * ================================
     * HAPUS USER (API)
     * ================================
     */
    public function destroy(User $user)
    {
        if ($user->role === 'admin') {
            return response()->json([
                'status' => false,
                'message' => 'Admin tidak bisa dihapus.'
            ], 400);
        }

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'User berhasil dihapus'
        ]);
    }
}