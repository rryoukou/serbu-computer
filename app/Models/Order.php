<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    // ✅ Kolom yang bisa diisi massal
    protected $fillable = [
        'user_id',
        'product_id',
        'nama_produk',
        'spesifikasi',
        'qty',
        'harga',
        'metode_pembayaran',
        'total_harga',
        'status',
        'batas_waktu',
        'bukti_bayar'
    ];

    // ✅ Casting datetime
    protected $casts = [
        'batas_waktu' => 'datetime',
    ];

    // =========================
    // RELASI KE USER
    // =========================
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // =========================
    // RELASI KE PRODUCT
    // =========================
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // =========================
    // HAPUS ORDER TUNAI YANG EXPIRED & KEMBALIKAN STOK
    // =========================
    public static function clearExpiredCashOrders()
    {
        $expiredOrders = self::where('metode_pembayaran', 'tunai')
            ->where('batas_waktu', '<', now())
            ->get();

        foreach ($expiredOrders as $order) {
            // Tambah stock produk kembali
            if ($order->product) {
                $order->product->increment('stock', $order->qty);
            }

            // Hapus order
            $order->delete();
        }
    }
}
