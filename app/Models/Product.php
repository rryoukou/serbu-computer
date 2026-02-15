<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Field yang boleh diisi lewat mass assignment
    protected $fillable = [
        'name',           // Nama produk
        'category',       // Kategori (Laptop / Aksesoris)
        'specs',          // Spesifikasi
        'price',          // Harga
        'stock',          // Stok
        'details',        // Detail barang
        'purchase_guide', // Panduan pembelian
        'photo',          // Foto
    ];

    /**
     * Relasi ke order_items (jika produk dibeli)
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
