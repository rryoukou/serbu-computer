@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-[#090069] via-[#0c0c3d] to-[#090069]">

    <!-- Hero Section -->
    <div class="bg-gradient-to-b from-[#090069] to-[#0c0c3d] py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 reveal">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">
                    <span class="text-[#F0B22B]">Riwayat</span> Pembelian
                </h1>
                <p class="text-gray-300 text-base md:text-lg">
                    Lacak semua pesanan dan transaksi Anda
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- FLASH MESSAGE --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-gradient-to-r from-green-500/20 to-green-600/20 border border-green-500/30 rounded-xl text-green-300 reveal">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-gradient-to-r from-red-500/20 to-red-600/20 border border-red-500/30 rounded-xl text-red-300 reveal">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    {{ $errors->first() }}
                </div>
            </div>
        @endif

        @if($orders->isEmpty())
            <!-- Empty State -->
            <div class="text-center py-12 md:py-16 reveal">
                <div class="w-16 h-16 md:w-20 md:h-20 bg-[#0c0c3d] rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 md:w-10 md:h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <h3 class="text-lg md:text-xl font-semibold text-white mb-2">Belum ada riwayat pembelian</h3>
                <p class="text-gray-400 text-sm md:text-base mb-6 max-w-md mx-auto">
                    Mulai berbelanja untuk melihat riwayat pembelian Anda di sini
                </p>
                <a href="{{ route('shop.index') }}" 
                   class="inline-block bg-[#F0B22B] text-black px-5 md:px-6 py-2 md:py-2.5 rounded-lg font-medium hover:bg-white transition-colors text-sm md:text-base">
                    Mulai Berbelanja
                </a>
            </div>
        @else
            <!-- Order Count -->
            <div class="mb-6 reveal">
                <p class="text-gray-300">
                    Total {{ $orders->count() }} pesanan ditemukan
                </p>
            </div>

            <!-- Orders Grid -->
            <div class="space-y-6 reveal">
                @foreach($orders as $index => $order)
                <div class="group bg-[#0c0c3d] rounded-2xl overflow-hidden text-white 
    shadow-[0_8px_24px_rgba(0,0,0,0.3)]
    transition-all duration-500 
    hover:-translate-y-1 hover:shadow-[0_16px_40px_rgba(240,178,43,0.15)]
    hover:border hover:border-[#F0B22B]/20
    relative
    before:absolute before:inset-0 
    before:pointer-events-none
    before:bg-gradient-to-br before:from-transparent before:via-transparent 
    before:to-[#F0B22B]/5 before:opacity-0 before:transition-opacity 
    before:duration-500 hover:before:opacity-100"
>

                    <!-- Header -->
                    <div class="p-6 border-b border-gray-700/50 bg-gradient-to-r from-[#0c0c3d] to-[#090069]/50">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div>
                                <h2 class="font-bold text-xl text-white mb-1">
                                    Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                </h2>
                                <div class="flex items-center text-gray-400 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </div>
                            </div>
                            
                            <!-- Status Badge -->
                            @php
                                $statusColors = [
                                    'selesai' => 'bg-green-500/20 text-green-300 border-green-500/30',
                                    'menunggu_pembayaran_tunai' => 'bg-yellow-500/20 text-yellow-300 border-yellow-500/30',
                                    'menunggu_verifikasi' => 'bg-blue-500/20 text-blue-300 border-blue-500/30'
                                ];
                                $statusTexts = [
                                    'selesai' => 'Selesai',
                                    'menunggu_pembayaran_tunai' => 'Menunggu Pembayaran',
                                    'menunggu_verifikasi' => 'Menunggu Verifikasi'
                                ];
                            @endphp
                            <span class="px-4 py-2 rounded-full border {{ $statusColors[$order->status] ?? 'bg-gray-500/20 text-gray-300' }} font-medium text-sm">
                                {{ $statusTexts[$order->status] ?? $order->status }}
                            </span>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="p-6">
                        @foreach($order->items as $itemIndex => $item)
                        <div class="flex gap-4 mb-4 pb-4 {{ !$loop->last ? 'border-b border-gray-700/30' : '' }}">
                            <!-- Product Image -->
                            <div class="flex-shrink-0">
                                <div class="w-20 h-20 bg-gradient-to-b from-[#003A8F] to-[#002a6a] rounded-lg overflow-hidden flex items-center justify-center">
                                    <img
                                        src="{{ $item->product && $item->product->photo
                                            ? asset('storage/' . $item->product->photo)
                                            : 'https://via.placeholder.com/80' }}"
                                        class="w-full h-full object-cover"
                                        alt="{{ $item->nama_produk }}"
                                    >
                                </div>
                            </div>
                            
                            <!-- Product Details -->
                            <div class="flex-1">
                                <h3 class="font-semibold text-white mb-1">{{ $item->nama_produk }}</h3>
                                <p class="text-gray-400 text-sm mb-2">Spesifikasi: {{ $item->spesifikasi }}</p>
                                
                                <div class="flex flex-wrap gap-4 text-sm">
                                    <span class="text-gray-300">
                                        Qty: <span class="text-white font-medium">{{ $item->qty }}</span>
                                    </span>
                                    <span class="text-gray-300">
                                        Harga: <span class="text-[#F0B22B] font-medium">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                                    </span>
                                    <span class="text-gray-300">
                                        Subtotal: <span class="text-[#F0B22B] font-medium">Rp {{ number_format($item->harga * $item->qty, 0, ',', '.') }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!-- Payment Method -->
                        <div class="mb-3">
                            <div class="inline-flex items-center px-3 py-1.5 rounded-lg bg-gray-800/50 border border-gray-700">
                                <svg class="w-4 h-4 mr-2 text-[#F0B22B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                                <span class="text-sm text-gray-300">
                                    Metode: <span class="text-white font-medium">{{ strtoupper($order->metode_pembayaran) }}</span>
                                </span>
                            </div>
                        </div>

                        <!-- Batas Waktu (if applicable) -->
                        @if($order->status === 'menunggu_pembayaran_tunai' && $order->batas_waktu)
                        <div class="mb-3 p-3 bg-gradient-to-r from-yellow-500/10 to-yellow-600/10 border border-yellow-500/20 rounded-lg">
                            <div class="flex items-center text-yellow-300 text-sm">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Batas waktu pembayaran: <span class="font-semibold">{{ \Carbon\Carbon::parse($order->batas_waktu)->format('d M Y, H:i') }}</span></span>
                            </div>
                        </div>
                        @endif

                        <!-- Bukti Pembayaran -->
                        @if($order->metode_pembayaran === 'bca' && $order->bukti_bayar)
                        <div class="mb-4">
                            <p class="text-sm text-gray-300 mb-2 font-medium">Bukti Pembayaran:</p>
                            <div class="relative inline-block">
                                <img
                                    src="{{ asset('storage/' . $order->bukti_bayar) }}"
                                    class="w-32 h-32 object-cover rounded-lg border-2 border-gray-700 cursor-pointer hover:border-[#F0B22B] transition-colors"
                                    onclick="toggleImage(this)"
                                    alt="Bukti Pembayaran"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent rounded-lg opacity-0 hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="text-white text-xs bg-black/50 px-2 py-1 rounded">Klik untuk zoom</span>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Pesan -->
                        @if($order->pesan)
                        <div class="mb-4 p-3 bg-gray-800/30 rounded-lg border border-gray-700/50">
                            <p class="text-sm text-gray-300 mb-1 font-medium">Pesan:</p>
                            <p class="text-white text-sm">{{ $order->pesan }}</p>
                        </div>
                        @endif

                        <!-- Total Harga -->
                        <div class="flex justify-between items-center pt-4 border-t border-gray-700/50">
                            <div>
                                <p class="text-sm text-gray-400">Total Pesanan</p>
                                <p class="text-2xl font-bold text-[#F0B22B]">
                                    Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                </p>
                            </div>
                            
                            <!-- Delete Button (if not completed) -->
                            @if($order->status !== 'selesai')
                            <form action="{{ route('riwayat.destroy', $order->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="px-4 py-2 bg-gradient-to-r from-red-500/20 to-red-600/20 text-red-300 border border-red-500/30 rounded-lg hover:bg-red-500/30 hover:text-white transition-colors text-sm font-medium flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus Pesanan
                                </button>
                            </form>
                            @else
                            <div class="text-green-400 text-sm font-medium flex items-center">
                                <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Pesanan Selesai
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Corner Accent -->
                    <div class="absolute top-0 right-0 w-12 h-12 
                                bg-gradient-to-bl from-[#F0B22B]/0 via-[#F0B22B]/0 to-[#F0B22B]/10 
                                rounded-bl-2xl transition-all duration-500 
                                group-hover:from-[#F0B22B]/10 group-hover:via-[#F0B22B]/5 
                                group-hover:to-[#F0B22B]/20">
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Show total orders count -->
            <div class="mt-8 pt-6 border-t border-gray-700/30 text-center reveal">
                <p class="text-gray-400 text-sm">
                    Menampilkan semua {{ $orders->count() }} pesanan. Urutan terbaru ke terlama.
                </p>
            </div>
        @endif
    </div>
</div>

{{-- SCRIPT ZOOM GAMBAR --}}
<script>
function toggleImage(img) {
    if (img.classList.contains('zoomed')) {
        img.classList.remove('zoomed');
        img.style = '';
        document.body.style.overflow = 'auto';
    } else {
        img.classList.add('zoomed');
        img.style.position = 'fixed';
        img.style.top = '50%';
        img.style.left = '50%';
        img.style.transform = 'translate(-50%, -50%) scale(1.5)';
        img.style.width = 'auto';
        img.style.maxWidth = '90vw';
        img.style.maxHeight = '90vh';
        img.style.zIndex = '9999';
        img.style.cursor = 'zoom-out';
        img.style.borderRadius = '8px';
        img.style.boxShadow = '0 25px 50px -12px rgba(0, 0, 0, 0.75)';
        img.style.border = '3px solid #F0B22B';
        document.body.style.overflow = 'hidden';
        
        // Add overlay
        const overlay = document.createElement('div');
        overlay.id = 'image-overlay';
        overlay.style.position = 'fixed';
        overlay.style.top = '0';
        overlay.style.left = '0';
        overlay.style.width = '100%';
        overlay.style.height = '100%';
        overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.9)';
        overlay.style.zIndex = '9998';
        overlay.style.cursor = 'zoom-out';
        overlay.onclick = function() {
            img.classList.remove('zoomed');
            img.style = '';
            document.body.style.overflow = 'auto';
            document.body.removeChild(overlay);
        };
        document.body.appendChild(overlay);
    }
}

// SCROLL REVEAL ANIMATION
document.addEventListener('DOMContentLoaded', function() {
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
});
</script>

<style>
    /* Line clamp for text */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Better mobile spacing */
    @media (max-width: 640px) {
        .flex-col.md\:flex-row {
            gap: 12px;
        }
        
        .text-2xl {
            font-size: 1.5rem;
        }
    }
</style>
@endsection