<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Jalankan pembersihan order expired otomatis saat admin buka dashboard
        // Ini memastikan data yang tampil adalah data yang valid (stok sudah balik)
        Order::clearExpiredCashOrders();

        // 1. Statistik Dasar
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();

        // 2. Logic Revenue (PENTING)
        // Kita hanya hitung total_harga dari order yang statusnya 'selesai'
        // Pakai (float) agar jika database kosong, hasilnya 0 bukan null
        $totalRevenue = (float) Order::where('status', 'selesai')->sum('total_harga');

        // 3. Statistik Order Spesifik
        $pendingOrders = Order::where('status', 'menunggu_verifikasi')->count();
        
        // Tambahan (Optional): Biar abang tau ada berapa duit yang masih nunggu dibayar user
        $potentialRevenue = (float) Order::whereIn('status', ['menunggu_verifikasi', 'menunggu_pembayaran_tunai'])
                                        ->sum('total_harga');

        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalProducts', 
            'totalOrders', 
            'totalRevenue', 
            'pendingOrders',
            'potentialRevenue'
        ));
    }
}