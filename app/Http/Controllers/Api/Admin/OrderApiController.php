<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class OrderApiController extends Controller
{
    /**
     * Menampilkan daftar transaksi dengan fitur pencarian
     */
    public function index(Request $request) // Tambahkan Request $request
    {
        try {
            // Ambil keyword search dari URL (?search=xxx)
            $search = $request->query('search');

            // Query dasar dengan Eager Loading user
            $query = Order::with('user');

            // Logic Pencarian (Hanya jalan jika user mengetik sesuatu)
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_produk', 'LIKE', "%{$search}%") // Cari berdasarkan Nama Produk
                      ->orWhere('id', 'LIKE', "%{$search}%")        // Atau ID Transaksi
                      ->orWhereHas('user', function ($qu) use ($search) {
                          $qu->where('nama', 'LIKE', "%{$search}%"); // Atau Nama Member/User
                      });
                });
            }

            // Urutkan dari yang terbaru dan buat pagination
            $orders = $query->orderBy('id', 'desc')->paginate(10);
            
            return response()->json([
                'status' => true,
                'message' => 'List Data Transaksi Berhasil Dimuat',
                'data' => $orders
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memuat data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Membuat transaksi baru (Admin/Offline)
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id'        => 'required|exists:products,id',
            'qty'               => 'required|integer|min:1',
            'metode_pembayaran' => 'required|string',
            'status'            => 'nullable|string',
            'user_id'           => 'nullable',
            'bukti_bayar'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        try {
            return DB::transaction(function () use ($request) {
                $product = Product::lockForUpdate()->findOrFail($request->product_id);

                if ($product->stock < $request->qty) {
                    return response()->json([
                        'status'  => false,
                        'message' => "Stok '{$product->name}' tidak mencukupi."
                    ], 400);
                }

                $total = $product->price * $request->qty;
                $metodeInput = strtolower($request->metode_pembayaran);
                $metode = (in_array($metodeInput, ['cash', 'tunai'])) ? 'tunai' : 'bca';
                
                // Penentuan status otomatis
                if ($request->filled('status')) {
                    $status = strtolower($request->status);
                } else {
                    $status = ($metode === 'tunai') ? 'menunggu_pembayaran_tunai' : 'menunggu_verifikasi';
                }

                // Handle Upload Bukti Bayar
                $pathBukti = null;
                if ($request->hasFile('bukti_bayar')) {
                    $pathBukti = $request->file('bukti_bayar')->store('bukti_transfer', 'public');
                }

                $order = Order::create([
                    'user_id'           => $request->user_id,
                    'product_id'        => $product->id,
                    'nama_produk'       => $product->name,
                    'spesifikasi'       => $product->description ?? '-', 
                    'qty'               => $request->qty,
                    'harga'             => $product->price,
                    'total_harga'       => $total,
                    'metode_pembayaran' => $metode,
                    'status'            => $status,
                    'bukti_bayar'       => $pathBukti,
                    'batas_waktu'       => ($metode === 'bca') ? now()->addHours(24) : null
                ]);

                // Kurangi Stok
                $product->decrement('stock', $request->qty);

                return response()->json([
                    'status'  => true,
                    'message' => 'Transaksi berhasil dibuat!',
                    'data'    => $order
                ], 201);
            });

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Memperbarui status transaksi
     */
    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Status diperlukan'], 422);
        }

        try {
            $order = Order::findOrFail($id);
            
            // Jika status berubah jadi batal, kembalikan stok
            if (strtolower($request->status) === 'batal' && $order->status !== 'batal') {
                Product::where('id', $order->product_id)->increment('stock', $order->qty);
            }

            $order->update([
                'status' => strtolower($request->status)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Status transaksi berhasil diperbarui',
                'data' => $order
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal update status: ' . $e->getMessage()
            ], 500);
        }
    }
}