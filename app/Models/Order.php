<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','nama_lengkap','no_hp','pesan',
        'metode_pembayaran','total_harga','status',
        'batas_waktu','bukti_bayar'
    ];

    protected $casts = [
        'batas_waktu' => 'datetime', // ✅ ini penting biar bisa pakai ->format()
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function clearExpiredCashOrders()
    {
        $expiredOrders = self::where('metode_pembayaran', 'tunai')
            ->where('batas_waktu', '<', now())
            ->get();

        foreach ($expiredOrders as $order) {
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->qty);
            }
            $order->delete();
        }
    }
}
