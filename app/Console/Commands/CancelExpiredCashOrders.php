<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;

class CancelExpiredCashOrders extends Command
{
    protected $signature = 'orders:cancel-expired';
    protected $description = 'Batalkan order tunai yang lewat batas waktu dan kembalikan stok';

    public function handle()
    {
        $orders = Order::where('metode_pembayaran', 'tunai')
            ->where('status', 'menunggu_pembayaran_tunai')
            ->where('batas_waktu', '<', now())
            ->get();

        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->qty); // kembalikan stok
            }

            $order->delete(); // hapus order
        }

        $this->info($orders->count() . ' order tunai expired dibatalkan.');
    }
}
