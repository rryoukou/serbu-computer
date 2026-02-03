@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-[#090069]">
    <!-- Header Section -->
    <div class="bg-gradient-to-b from-[#090069] to-[#0c0c3d] py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 reveal">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">
                    Your <span class="text-[#F0B22B]">Shopping Cart</span>
                </h1>
                <p class="text-gray-300 text-base md:text-lg">
                    Review and manage your selected items
                </p>
            </div>
        </div>
    </div>

    <!-- Cart Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-900/30 border border-green-500 rounded-lg text-green-300 reveal">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-900/30 border border-red-500 rounded-lg text-red-300 reveal">
                {{ session('error') }}
            </div>
        @endif

        @if(session('cart') && count(session('cart')) > 0)
            <div class="bg-[#0c0c3d] rounded-2xl overflow-hidden shadow-[0_8px_24px_rgba(0,0,0,0.3)] reveal">
                <!-- Cart Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-[#003A8F] to-[#002a6a]">
                                <th class="p-4 text-left text-white font-semibold">Produk</th>
                                <th class="p-4 text-left text-white font-semibold">Harga</th>
                                <th class="p-4 text-left text-white font-semibold">Qty</th>
                                <th class="p-4 text-left text-white font-semibold">Total</th>
                                <th class="p-4 text-center text-white font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $grandTotal = 0; @endphp
                            @foreach(session('cart') as $id => $item)
                                @php
                                    $total = $item['price'] * $item['qty'];
                                    $grandTotal += $total;
                                @endphp
                                <tr class="border-b border-gray-800 hover:bg-gray-900/30 transition-colors">
                                    <!-- Produk -->
                                    <td class="p-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-20 h-20 bg-gradient-to-b from-[#003A8F] to-[#002a6a] rounded-lg flex items-center justify-center overflow-hidden">
                                                <img src="{{ $item['photo'] ? asset('storage/' . $item['photo']) : 'https://via.placeholder.com/80' }}"
                                                     alt="{{ $item['name'] }}"
                                                     class="w-full h-full object-contain p-2">
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-white mb-1">{{ $item['name'] }}</h3>
                                                <p class="text-sm text-gray-400">SKU: {{ $id }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!-- Harga -->
                                    <td class="p-4">
                                        <p class="text-[#F0B22B] font-semibold text-lg">
                                            Rp {{ number_format($item['price'], 0, ',', '.') }}
                                        </p>
                                        <p class="text-sm text-gray-400">per unit</p>
                                    </td>
                                    
                                    <!-- Quantity -->
                                    <td class="p-4">
                                        <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            <div class="relative">
                                                <input type="number" 
                                                       name="qty" 
                                                       value="{{ $item['qty'] }}" 
                                                       min="1" 
                                                       max="{{ $item['stock'] ?? 2 }}"
                                                       class="w-24 px-4 py-2 bg-gray-900 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#F0B22B] focus:border-transparent">
                                            </div>
                                            <button type="submit" 
                                                    class="bg-[#003A8F] hover:bg-[#002a6a] text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                                Update
                                            </button>
                                        </form>
                                    </td>
                                    
                                    <!-- Total -->
                                    <td class="p-4">
                                        <p class="text-[#F0B22B] font-bold text-xl">
                                            Rp {{ number_format($total, 0, ',', '.') }}
                                        </p>
                                    </td>
                                    
                                    <!-- Aksi -->
                                    <td class="p-4">
                                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-4 py-2 rounded-lg font-medium transition-all shadow-lg hover:shadow-red-500/20"
                                                    onclick="return confirm('Hapus produk dari keranjang?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Summary Section -->
                <div class="p-6 bg-gradient-to-r from-gray-900 to-[#0c0c3d] border-t border-gray-800">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                        <!-- Continue Shopping -->
                        <a href="{{ route('shop.index') }}" 
                           class="inline-flex items-center gap-2 text-[#F0B22B] hover:text-white font-medium transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Lanjutkan Belanja
                        </a>

                        <!-- Grand Total & Checkout -->
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                            <!-- Grand Total -->
                            <div class="text-right">
                                <p class="text-gray-400 text-sm mb-1">Grand Total</p>
                                <p class="text-[#F0B22B] font-bold text-3xl">
                                    Rp {{ number_format($grandTotal, 0, ',', '.') }}
                                </p>
                                <p class="text-gray-400 text-xs mt-1">Termasuk semua pajak</p>
                            </div>

                            <!-- Checkout Button -->
                            <form action="{{ route('checkout.show', array_key_first(session('cart'))) }}" method="GET">
                                <button type="submit"
                                        class="bg-gradient-to-r from-[#F0B22B] to-yellow-500 hover:from-yellow-500 hover:to-[#F0B22B] text-black px-8 py-3 rounded-lg font-bold text-lg transition-all duration-300 shadow-lg hover:shadow-[#F0B22B]/30 hover:scale-105">
                                    Checkout Now
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <!-- Shipping Info -->
                <div class="bg-[#0c0c3d] p-6 rounded-2xl border border-gray-800 reveal" style="transition-delay: 100ms">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#003A8F] to-[#002a6a] rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#F0B22B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white">Pengiriman Gratis</h3>
                    </div>
                    <p class="text-gray-400 text-sm">
                        Gratis ongkir untuk semua pesanan di atas Rp 500.000
                    </p>
                </div>

                <!-- Return Policy -->
                <div class="bg-[#0c0c3d] p-6 rounded-2xl border border-gray-800 reveal" style="transition-delay: 200ms">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#003A8F] to-[#002a6a] rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#F0B22B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white">Return 30 Hari</h3>
                    </div>
                    <p class="text-gray-400 text-sm">
                        Garansi pengembalian 30 hari untuk semua produk
                    </p>
                </div>

                <!-- Secure Payment -->
                <div class="bg-[#0c0c3d] p-6 rounded-2xl border border-gray-800 reveal" style="transition-delay: 300ms">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#003A8F] to-[#002a6a] rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#F0B22B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white">Pembayaran Aman</h3>
                    </div>
                    <p class="text-gray-400 text-sm">
                        Transaksi aman dengan enkripsi SSL 256-bit
                    </p>
                </div>
            </div>

        @else
            <!-- Empty Cart -->
            <div class="text-center py-16 reveal">
                <div class="w-32 h-32 bg-gradient-to-br from-[#0c0c3d] to-[#003A8F] rounded-full flex items-center justify-center mx-auto mb-6 relative">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <div class="absolute inset-0 rounded-full border-2 border-[#F0B22B]/20 animate-ping"></div>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3">Keranjang Belanja Kosong</h3>
                <p class="text-gray-400 text-lg mb-8 max-w-md mx-auto">
                    Belum ada produk di keranjang Anda. Mulai jelajahi produk kami!
                </p>
                <a href="{{ route('shop.index') }}" 
                   class="inline-flex items-center gap-2 bg-gradient-to-r from-[#F0B22B] to-yellow-500 hover:from-yellow-500 hover:to-[#F0B22B] text-black px-8 py-3 rounded-lg font-bold text-lg transition-all duration-300 shadow-lg hover:shadow-[#F0B22B]/30 hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        /* ===============================
           SCROLL REVEAL ANIMATION
        =============================== */
        const reveals = document.querySelectorAll('.reveal');

        reveals.forEach(el => {
            el.classList.add(
                'opacity-0',
                'translate-y-10',
                'transition',
                'duration-700',
                'ease-out'
            );
        });

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove('opacity-0', 'translate-y-10');
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        reveals.forEach(el => observer.observe(el));

        // Quantity input validation
        document.querySelectorAll('input[name="qty"]').forEach(input => {
            input.addEventListener('change', function() {
                const max = parseInt(this.max);
                const value = parseInt(this.value);
                
                if (value < 1) {
                    this.value = 1;
                } else if (value > max) {
                    this.value = max;
                    alert('Jumlah maksimal adalah ' + max);
                }
            });
        });
    });
</script>

<style>
    /* Custom scrollbar for cart table */
    .overflow-x-auto::-webkit-scrollbar {
        height: 6px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-track {
        background: #0c0c3d;
        border-radius: 10px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #F0B22B;
        border-radius: 10px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #ffcc33;
    }
    
    /* Input number arrows styling */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        opacity: 1;
        height: 24px;
        margin-right: 4px;
    }
    
    /* Smooth transitions */
    * {
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        table thead {
            display: none;
        }
        
        table tbody tr {
            display: block;
            border-bottom: 2px solid #1a1a3d;
            margin-bottom: 16px;
            background: #0c0c3d;
            border-radius: 12px;
            overflow: hidden;
        }
        
        table tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 16px;
            border-bottom: 1px solid #1a1a3d;
        }
        
        table tbody td:last-child {
            border-bottom: none;
        }
        
        table tbody td::before {
            content: attr(data-label);
            font-weight: bold;
            color: #F0B22B;
            margin-right: 12px;
        }
    }
</style>
@endsection