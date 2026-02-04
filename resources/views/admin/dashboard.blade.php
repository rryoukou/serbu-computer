@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('content')
<div class="mb-10">
    <h2 class="text-white text-3xl font-bold">Admin Dashboard Overview</h2>
    <p class="text-gray-400 mt-2">Selamat datang kembali! Berikut adalah ringkasan performa toko Serbu Comp hari ini.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    
    <div class="bg-white p-6 rounded-[24px] shadow-sm flex items-center justify-between border border-white/10 hover:shadow-md transition-shadow">
        <div>
            <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Total User</p>
            <h3 class="text-3xl font-bold text-[#090069] mt-1">{{ $totalUsers }}</h3>
        </div>
        <div class="bg-[#F0B22B]/10 p-3 rounded-2xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#F0B22B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
        </div>
    </div>

    <div class="bg-white p-6 rounded-[24px] shadow-sm flex items-center justify-between border border-white/10 hover:shadow-md transition-shadow">
        <div>
            <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Total Product</p>
            <h3 class="text-3xl font-bold text-[#090069] mt-1">{{ $totalProducts }}</h3>
        </div>
        <div class="bg-[#F0B22B]/10 p-3 rounded-2xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#F0B22B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
        </div>
    </div>

    <div class="bg-white p-6 rounded-[24px] shadow-sm flex items-center justify-between border border-white/10 hover:shadow-md transition-shadow">
        <div>
            <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Total Transaction</p>
            <h3 class="text-3xl font-bold text-[#090069] mt-1">{{ $totalOrders }}</h3>
        </div>
        <div class="bg-[#F0B22B]/10 p-3 rounded-2xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#F0B22B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
            </svg>
        </div>
    </div>

    <div class="bg-white p-6 rounded-[24px] shadow-sm flex items-center justify-between border border-white/10 hover:shadow-md transition-shadow">
        <div>
            <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Revenue</p>
            <h3 class="text-2xl font-bold text-[#090069] mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
        </div>
        <div class="bg-[#F0B22B]/10 p-3 rounded-2xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#F0B22B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
    </div>

    <div class="bg-white p-6 rounded-[24px] shadow-sm flex items-center justify-between border border-white/10 hover:shadow-md transition-shadow">
        <div>
            <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Pending Orders</p>
            <h3 class="text-3xl font-bold text-red-500 mt-1">{{ $pendingOrders }}</h3>
        </div>
        <div class="bg-red-50/50 p-3 rounded-2xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
    </div>

    <a href="{{ route('admin.products.index') }}" 
       class="bg-[#F0B22B] p-6 rounded-[24px] shadow-lg flex items-center justify-between hover:scale-[1.02] active:scale-[0.98] transition-all cursor-pointer group">
        <div>
            <p class="text-[#090069]/60 text-sm font-bold uppercase tracking-wider">Quick Action</p>
            <h3 class="text-xl font-extrabold text-[#090069] mt-1">Manage Product</h3>
        </div>
        <div class="bg-white/20 p-3 rounded-2xl group-hover:bg-white/40 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#090069]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </div>
    </a>

</div>
@endsection