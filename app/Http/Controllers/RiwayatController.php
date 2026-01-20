<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    // =========================
    // TAMPILKAN RIWAYAT PEMBELIAN USER
    // =========================
    public function index()
    {
        $user = Auth::user();

        $orders = Order::with(['items.product'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('riwayat.index', compact('orders'));
    }

    // =========================
    // HAPUS PESANAN (JIKA BELUM SELESAI)
    // =========================
    public function destroy(Order $order)
    {
        // Pastikan pesanan milik user login
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan');
        }

        // Jika pesanan sudah selesai, tidak boleh dihapus
        if ($order->status === 'selesai') {
            return back()->withErrors([
                'hapus' => 'Pesanan yang sudah selesai tidak dapat dihapus.'
            ]);
        }

        DB::transaction(function () use ($order) {

            // Kembalikan stok produk
            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->increment('stock', $item->qty);
                }
            }

            // Hapus order items
            $order->items()->delete();

            // Hapus order
            $order->delete();
        });

        return redirect()
            ->route('riwayat.index')
            ->with('success', 'Pesanan berhasil dihapus dan stok dikembalikan.');
    }
}
