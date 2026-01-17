<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    // Tampilkan semua riwayat pembelian user
    public function index()
    {
        $user = Auth::user();

        $orders = Order::with('items') // ambil detail order item
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('riwayat.index', compact('orders'));
    }
}
