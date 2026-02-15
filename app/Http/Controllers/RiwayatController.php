<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
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

        // Ambil semua order milik user login
        $orders = Order::where('user_id', $user->id)
            ->latest()
            ->get();

        return view('riwayat.index', compact('orders'));
    }

    // =========================
    // BATALKAN PESANAN
    // =========================
    public function cancel(Order $order)
    {
        // Pastikan pesanan milik user login
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan');
        }

        // Jika pesanan sudah selesai atau sudah dibatalkan, tidak bisa dibatalkan lagi
        if (in_array($order->status, ['selesai', 'dibatalkan'])) {
            return back()->withErrors([
                'cancel' => 'Pesanan tidak dapat dibatalkan.'
            ]);
        }

        DB::transaction(function () use ($order) {

            // Kembalikan stok produk
            $product = Product::find($order->product_id);
            if ($product) {
                $product->increment('stock', $order->qty);
            }

            // Update status jadi dibatalkan
            $order->update([
                'status' => 'dibatalkan'
            ]);
        });

        return redirect()
            ->route('riwayat.index')
            ->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
