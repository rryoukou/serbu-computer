<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Halaman checkout
    public function show(Product $product)
    {
        $user = auth()->user();
        $lastOrder = Order::where('user_id', $user->id)->latest()->first();

        // Hapus order tunai expired sebelum checkout
        Order::clearExpiredCashOrders();

        return view('checkout.index', compact('product', 'user', 'lastOrder'));
    }

    // Simpan transaksi baru
    public function store(Request $request, Product $product)
    {
        $user = Auth::user();

        // Hapus order tunai expired sebelum transaksi
        Order::clearExpiredCashOrders();

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'pesan' => 'nullable|string',
            'metode_pembayaran' => 'required|in:tunai,bca',
            'qty' => 'required|integer|min:1|max:2',
            'bukti_bayar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $qty = $request->qty;

        // ======================
        // HITUNG TOTAL PEMBELIAN USER UNTUK PRODUK INI
        // Hanya order BELUM selesai yang dihitung
        $totalSebelumnya = OrderItem::whereHas('order', function($q) use ($user) {
            $q->where('user_id', $user->id)
              ->whereIn('status', ['menunggu_pembayaran_tunai','menunggu_verifikasi']); // order belum selesai
        })->where('product_id', $product->id)->sum('qty');

        if ($totalSebelumnya + $qty > 2) {
            return back()->withErrors(['qty' => 'Pembelian maksimal 2 untuk produk yang sama'])->withInput();
        }
        // ======================

        // Hitung total harga
        $totalHarga = $product->price * $qty;

        // Tentukan status & batas waktu
        if ($request->metode_pembayaran === 'tunai') {
            $status = 'menunggu_pembayaran_tunai';
            $batasWaktu = now()->addMinutes(2880); // 2 hari
        } else {
            $status = 'menunggu_verifikasi';
            $batasWaktu = null; // BCA tidak ada tenggang waktu
        }

        // Kurangi stok
        if ($product->stock < $qty) {
            return back()->withErrors(['qty' => 'Stok produk tidak mencukupi'])->withInput();
        }
        $product->decrement('stock', $qty);

        // Simpan order
        $order = Order::create([
            'user_id' => $user->id,
            'nama_lengkap' => $request->nama_lengkap,
            'no_hp' => $request->no_hp,
            'pesan' => $request->pesan,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total_harga' => $totalHarga,
            'status' => $status,
            'batas_waktu' => $batasWaktu,
        ]);

        // Upload bukti BCA
        if ($request->metode_pembayaran === 'bca' && $request->hasFile('bukti_bayar')) {
            $path = $request->file('bukti_bayar')->store('bukti', 'public');
            $order->bukti_bayar = $path;
            $order->save();
        }

        // Simpan order items
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'nama_produk' => $product->name,
            'spesifikasi' => $product->specs,
            'qty' => $qty,
            'harga' => $product->price,
        ]);

        return redirect()->route('riwayat.index')->with('success', 'Transaksi berhasil dibuat!');
    }
}
