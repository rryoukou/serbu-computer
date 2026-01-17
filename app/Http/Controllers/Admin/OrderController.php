<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Tampilkan semua transaksi di admin
    public function index()
    {
        $orders = Order::with('items', 'user')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Update status selesai / belum selesai
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:selesai,belum_selesai'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status berhasil diubah!');
    }
}
