<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderApiController extends Controller
{
    /**
     * ================================
     * LIST SEMUA TRANSAKSI (API)
     * ================================
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $perPage = $request->get('per_page', 6);

        $orders = Order::with('user')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('user', function ($sub) use ($search) {
                        $sub->where('username', 'like', "%{$search}%")
                            ->orWhere('nama', 'like', "%{$search}%");
                    })
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%")
                    ->orWhere('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nama_produk', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate($perPage);

        return response()->json([
            'status' => true,
            'message' => 'List transaksi',
            'data' => $orders
        ]);
    }

    /**
     * ================================
     * SIMPAN TRANSAKSI OFFLINE (API)
     * ================================
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $product = Product::lockForUpdate()->findOrFail($request->product_id);

            if ($product->stock < $request->qty) {
                return response()->json([
                    'status' => false,
                    'message' => 'Stok tidak mencukupi.'
                ], 400);
            }

            $total = $product->price * $request->qty;

            $status = $request->metode_pembayaran === 'bca'
                ? 'menunggu_verifikasi'
                : 'menunggu_pembayaran_tunai';

            $order = Order::create([
                'user_id' => auth()->id() ?? null,
                'nama_produk' => $product->name,
                'product_id' => $product->id,
                'qty' => $request->qty,
                'harga' => $product->price,
                'total_harga' => $total,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status' => $status,
                'bukti_bayar' => null,
                'batas_waktu' => null
            ]);

            $product->decrement('stock', $request->qty);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Transaksi berhasil ditambahkan',
                'data' => $order
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * ================================
     * UPDATE STATUS TRANSAKSI (API)
     * ================================
     */
    public function updateStatus(Request $request, Order $order)
    {
        if ($order->status === 'dibatalkan') {
            return response()->json([
                'status' => false,
                'message' => 'Status sudah dibatalkan dan tidak bisa diubah.'
            ], 400);
        }

        $request->validate([
            'status' => 'required|in:menunggu_pembayaran_tunai,menunggu_verifikasi,selesai'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Status berhasil diubah',
            'data' => $order
        ]);
    }
}