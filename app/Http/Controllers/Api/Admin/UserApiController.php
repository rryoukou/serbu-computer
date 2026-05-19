<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Exception;

class UserApiController extends Controller
{
    /**
     * Ambil list user dengan pagination dan search
     */
    public function index(Request $request)
    {
        try {
            $search = $request->search;
            $perPage = $request->get('per_page', 5);

            // Filter role 'pengguna' (sesuaikan jika role kamu 'member')
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
                'message' => 'List user berhasil dimuat',
                'data' => $users
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memuat list user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * INI YANG TADI KURANG: Tampilkan Detail 1 User
     * Digunakan oleh popup ViewMember di C#
     */
    public function show($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User dengan ID ' . $id . ' tidak ditemukan.'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Detail user ditemukan',
                'data' => $user
            ]);
        } catch (Exception $e) {
            // Log error untuk debug di storage/logs/laravel.log
            Log::error("Error Show User: " . $e->getMessage());
            
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan pada server: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * TOGGLE BAN USER
     */
    public function toggleBan($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User tidak ditemukan.'
                ], 404);
            }

            if ($user->role === 'admin') {
                return response()->json([
                    'status' => false,
                    'message' => 'Akses ditolak: Admin tidak bisa dibanned.'
                ], 400);
            }

            $user->is_banned = !$user->is_banned;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Status user ' . $user->nama . ' berhasil diperbarui.',
                'is_banned' => (bool)$user->is_banned,
                'data' => $user
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengubah status ban: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * HAPUS USER
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User tidak ditemukan.'
                ], 404);
            }

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
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus user: ' . $e->getMessage()
            ], 500);
        }
    }
}