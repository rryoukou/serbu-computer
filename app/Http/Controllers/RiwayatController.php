<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    // 🔥 BATAS HARI AUTO CANCEL (UBAH DI SINI)
    private $limitDays = 2;

    // =========================
    // TAMPILKAN RIWAYAT + AUTO CANCEL
    // =========================
    public function index()
    {
        $user = Auth::user();

        // 🔥 AUTO CANCEL ORDER CASH YANG LEWAT BATAS
        $expiredOrders = Order::where('user_id', $user->id)
            ->where('status', 'menunggu_pembayaran_tunai')
            ->where('created_at', '<', now()->subDays($this->limitDays))
            ->get();

        foreach ($expiredOrders as $order) {
            DB::transaction(function () use ($order) {

                // Balikin stok
                $product = Product::find($order->product_id);
                if ($product) {
                    $product->increment('stock', $order->qty);
                }

                // Update status
                $order->update([
                    'status' => 'dibatalkan'
                ]);
            });
        }

        // Ambil ulang data setelah auto cancel
        $orders = Order::where('user_id', $user->id)
            ->latest()
            ->get();

        return view('riwayat.index', compact('orders'));
    }

    // =========================
    // CANCEL MANUAL
    // =========================
    public function cancel(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan');
        }

        if (in_array($order->status, ['selesai', 'dibatalkan'])) {
            return back()->withErrors([
                'cancel' => 'Pesanan tidak dapat dibatalkan.'
            ]);
        }

        DB::transaction(function () use ($order) {

            $product = Product::find($order->product_id);
            if ($product) {
                $product->increment('stock', $order->qty);
            }

            $order->update([
                'status' => 'dibatalkan'
            ]);
        });

        return redirect()
            ->route('riwayat.index')
            ->with('success', 'Pesanan berhasil dibatalkan.');
    }

    // =========================
    // 🔥 TEST AUTO CANCEL (UNTUK DEMO KE DOSEN)
    // =========================
    public function simulateExpired()
{
    $user = Auth::user();

    $orders = Order::where('user_id', $user->id)
        ->where('status', 'menunggu_pembayaran_tunai')
        ->get();

    foreach ($orders as $order) {

        // Paksa update tanpa sentuh updated_at
        DB::table('orders')
            ->where('id', $order->id)
            ->update([
                'created_at' => now()->subDays(3),
            ]);
    }

    return back()->with('success', 'Tanggal order dimundurkan 3 hari. Refresh halaman.');
}
}