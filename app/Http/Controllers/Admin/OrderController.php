<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * ================================
     * TAMPILKAN SEMUA TRANSAKSI
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
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * ================================
     * FORM TAMBAH TRANSAKSI OFFLINE
     * ================================
     */
    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        $users = User::where('role', 'pengguna')->get();

        return view('admin.orders.create', compact('products', 'users'));
    }

    /**
     * ================================
     * SIMPAN TRANSAKSI OFFLINE
     * ================================
     */
    public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'qty' => 'required|integer|min:1',
        'metode_pembayaran' => 'required|string',
        'user_id' => 'nullable|exists:users,id',
        'bukti_bayar' => 'nullable|image|mimes:jpg,jpeg,png|max:5120'
    ]);

    DB::transaction(function () use ($request) {

        $product = Product::lockForUpdate()->findOrFail($request->product_id);

        if ($product->stock < $request->qty) {
            throw new \Exception('Stok tidak mencukupi.');
        }

        $total = $product->price * $request->qty;

        // Upload bukti kalau ada
        $buktiPath = null;

        if ($request->hasFile('bukti_bayar')) {
            $buktiPath = $request->file('bukti_bayar')
                ->store('bukti_transfer', 'public');
        }

        // Tentukan status otomatis
        $status = $request->metode_pembayaran === 'bca'
            ? 'menunggu_verifikasi'
            : 'menunggu_pembayaran_tunai';

        Order::create([
'user_id' => auth()->id(),    'nama_produk' => $product->name,
    'product_id' => $product->id,
    'qty' => $request->qty,
    'harga' => $product->price, // WAJIB ADA INI
    'total_harga' => $total,
    'metode_pembayaran' => $request->metode_pembayaran,
    'status' => $status,
    'bukti_bayar' => $buktiPath,
    'batas_waktu' => null
]);

        $product->decrement('stock', $request->qty);
    });

    return redirect()
        ->route('admin.orders.index')
        ->with('success', 'Transaksi offline berhasil ditambahkan.');
}

    /**
     * ================================
     * UPDATE STATUS TRANSAKSI
     * ================================
     */
    public function updateStatus(Request $request, Order $order)
    {
        if ($order->status === 'dibatalkan') {
            return back()->withErrors([
                'status' => 'Status sudah dibatalkan oleh user dan tidak bisa diubah.'
            ]);
        }

        $request->validate([
            'status' => 'required|in:menunggu_pembayaran_tunai,menunggu_verifikasi,selesai'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status berhasil diubah!');
    }
}