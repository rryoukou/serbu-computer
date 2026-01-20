<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // =========================
    // HALAMAN CHECKOUT
    // =========================
    public function show(Product $product)
    {
        $user = auth()->user();

        // Hapus order tunai yang expired
        Order::clearExpiredCashOrders();

        $lastOrder = Order::where('user_id', $user->id)->latest()->first();

        return view('checkout.index', compact('product', 'user', 'lastOrder'));
    }

    // =========================
    // SIMPAN TRANSAKSI
    // =========================
    public function store(Request $request, Product $product)
    {
        $user = Auth::user();

        // Hapus order tunai yang expired
        Order::clearExpiredCashOrders();

        // =========================
        // VALIDASI (BCA WAJIB BUKTI)
        // =========================
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'pesan' => 'nullable|string',
            'metode_pembayaran' => 'required|in:tunai,bca',
            'qty' => 'required|integer|min:1|max:2',
            'bukti_bayar' => $request->metode_pembayaran === 'bca'
                ? 'required|image|mimes:jpg,jpeg,png|max:2048'
                : 'nullable',
        ], [
            'bukti_bayar.required' => 'Bukti pembayaran BCA wajib diupload.',
        ]);

        $qty = (int) $request->qty;

        // =========================
        // CEK BATAS MAKS 2 (HANYA ORDER BELUM SELESAI)
        // =========================
        $totalSebelumnya = OrderItem::whereHas('order', function ($q) use ($user) {
            $q->where('user_id', $user->id)
              ->whereIn('status', [
                  'menunggu_pembayaran_tunai',
                  'menunggu_verifikasi'
              ]);
        })->where('product_id', $product->id)
          ->sum('qty');

        if ($totalSebelumnya + $qty > 2) {
            return back()
                ->withErrors(['qty' => 'Pembelian maksimal 2 untuk produk yang sama (yang belum selesai).'])
                ->withInput();
        }

        // =========================
        // CEK STOK
        // =========================
        if ($product->stock < $qty) {
            return back()
                ->withErrors(['qty' => 'Stok produk tidak mencukupi.'])
                ->withInput();
        }

        // =========================
        // HITUNG TOTAL & STATUS
        // =========================
        $totalHarga = $product->price * $qty;

        if ($request->metode_pembayaran === 'tunai') {
            $status = 'menunggu_pembayaran_tunai';
            $batasWaktu = now()->addMinutes(2880); // 2 hari
        } else {
            $status = 'menunggu_verifikasi';
            $batasWaktu = null;
        }

        // =========================
        // TRANSAKSI DATABASE (AMAN)
        // =========================
        DB::transaction(function () use (
            $request,
            $user,
            $product,
            $qty,
            $totalHarga,
            $status,
            $batasWaktu
        ) {
            // Kurangi stok
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

            // Upload bukti BCA (PASTI ADA KARENA VALIDASI)
            if ($request->metode_pembayaran === 'bca') {
                $path = $request->file('bukti_bayar')->store('bukti', 'public');
                $order->update([
                    'bukti_bayar' => $path
                ]);
            }

            // Simpan item order
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'nama_produk' => $product->name,
                'spesifikasi' => $product->specs,
                'qty' => $qty,
                'harga' => $product->price,
            ]);
        });

        return redirect()
            ->route('riwayat.index')
            ->with('success', 'Transaksi berhasil dibuat!');
    }
}
