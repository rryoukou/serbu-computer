<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Tampilkan semua transaksi (dengan search + pagination)
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $orders = Order::with('user')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('username', 'like', "%{$search}%")
                      ->orWhere('nama', 'like', "%{$search}%");
                })
                ->orWhere('status', 'like', "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Update status transaksi
     */
    public function updateStatus(Request $request, Order $order)
    {
        // ❌ Jika status sudah dibatalkan, admin tidak boleh mengubah
        if ($order->status === 'dibatalkan') {
            return back()->withErrors([
                'status' => 'Status sudah dibatalkan oleh user, tidak dapat diubah oleh admin.'
            ]);
        }

        // ✅ Validasi enum terbaru (tidak termasuk 'dibatalkan')
        $request->validate([
            'status' => 'required|in:menunggu_pembayaran_tunai,menunggu_verifikasi,selesai'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status berhasil diubah!');
    }
}
