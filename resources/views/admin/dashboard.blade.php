@extends('layouts.admin')

@section('content')
<h1 class="text-3xl font-bold mb-6">Dashboard Admin</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="p-4 bg-white rounded shadow">
        <h2 class="font-semibold">Total Pengguna</h2>
        <p class="text-2xl font-bold">{{ $totalUsers }}</p>
    </div>

    <div class="p-4 bg-white rounded shadow">
        <h2 class="font-semibold">Total Produk</h2>
        <p class="text-2xl font-bold">{{ $totalProducts }}</p>
    </div>

    <div class="p-4 bg-white rounded shadow">
        <h2 class="font-semibold">Total Transaksi</h2>
        <p class="text-2xl font-bold">{{ $totalOrders }}</p>
    </div>

    <div class="p-4 bg-white rounded shadow">
        <h2 class="font-semibold">Pendapatan Total</h2>
        <p class="text-2xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
    </div>

    <div class="p-4 bg-white rounded shadow">
        <h2 class="font-semibold">Transaksi Pending</h2>
        <p class="text-2xl font-bold">{{ $pendingOrders }}</p>
    </div>
</div>
@endsection
