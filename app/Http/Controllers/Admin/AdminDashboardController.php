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
        // Statistik dasar
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_harga');
        $pendingOrders = Order::where('status', 'menunggu_verifikasi')->count();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalProducts', 'totalOrders', 'totalRevenue', 'pendingOrders'
        ));
    }
}
