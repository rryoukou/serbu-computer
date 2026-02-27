<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlists'; // opsional, tapi biar jelas

    protected $fillable = [
        'user_id',
        'product_id',
    ];

    // ========================
    // RELASI KE USER
    // ========================
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ========================
    // RELASI KE PRODUCT
    // ========================
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}