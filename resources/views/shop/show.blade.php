@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-[#090069] py-6">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 reveal-item opacity-0 transform translate-y-8 transition-all duration-700">
            {{-- GAMBAR PRODUK --}}
            <div class="relative group"> 
                {{-- Container Foto Kotak --}}
                <div class="bg-gradient-to-b from-[#003A8F] to-[#002a6a] rounded-2xl p-4 shadow-2xl overflow-hidden aspect-square flex items-center justify-center border border-white/5">
                    <div class="bg-gradient-to-b from-[#001f4d] to-[#001536] rounded-xl overflow-hidden w-full h-full flex items-center justify-center">
                        <img
                            src="{{ $product->photo ? asset('storage/' . $product->photo) : asset('images/placeholder.png') }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    </div>
                </div>

                @php
                    $isWishlisted = session('wishlist') && isset(session('wishlist')[$product->id]);
                @endphp

                <div class="absolute top-6 right-6 z-20">
                    <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-[#090069]/50 backdrop-blur-md p-2 rounded-full transition-transform duration-300 hover:scale-110 border border-white/10">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-7 h-7 transition-all duration-300 {{ $isWishlisted ? 'fill-[#F0B22B]' : 'fill-none stroke-white' }}" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3 9.24 3 10.91 3.81 12 5.08 13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5 22 12.28 18.6 15.36 13.45 20.04 L12 21.35z"/>
                            </svg>
                        </button>
                    </form>
                </div>

                {{-- CATEGORY --}}
                <div class="mt-4">
                    <span class="inline-block px-4 py-1.5 bg-[#F0B22B] text-black font-bold rounded-full text-xs uppercase tracking-widest">
                        {{ $product->category ?? 'Produk' }}
                    </span>
                </div>
            </div>

            {{-- DETAIL PRODUK --}}
            <div class="text-white flex flex-col">
                {{-- Nama Produk --}}
                <div class="mb-6">
                    <h1 class="text-2xl md:text-4xl font-black text-left leading-tight group-hover:text-[#F0B22B] transition-colors">{{ $product->name }}</h1>
                </div>

                {{-- Harga dan Status --}}
                <div class="mb-6 p-4 md:p-6 bg-[#0c0c3d] rounded-2xl border border-white/5 shadow-xl">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 space-y-3 md:space-y-0">
                        <div class="text-left">
                            <p class="text-gray-400 text-xs uppercase tracking-widest mb-1">Harga Sekarang</p>
                            <p class="text-2xl md:text-3xl font-black text-[#F0B22B]">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>
                        
                        <div class="text-left md:text-right">
                            <p class="text-gray-400 text-xs uppercase tracking-widest mb-1">Ketersediaan</p>
                            @if ($product->stock > 0)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-500/20 text-green-400 border border-green-500/30 font-bold rounded-full text-xs uppercase">
                                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                    Tersedia
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-500/20 text-red-400 border border-red-500/30 font-bold rounded-full text-xs uppercase">
                                    Habis
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pt-4 border-t border-white/5 space-y-2 sm:space-y-0">
                        <div class="text-gray-400 text-sm">
                            Stok: <span class="text-white font-bold">{{ $product->stock }} unit</span>
                        </div>
                        @if($product->stock > 0 && $product->stock <= 5)
                        <div class="text-orange-400 text-[10px] font-bold bg-orange-900/30 px-3 py-1 rounded-full border border-orange-500/20 uppercase tracking-tighter">
                            ⚠️ Stok Sangat Terbatas!
                        </div>
                        @endif
                    </div>
                </div>

                {{-- INFORMASI DETAIL --}}
                <div class="space-y-4">
                    {{-- Spesifikasi --}}
                    @if ($product->specs)
                    <div class="bg-[#0c0c3d] rounded-2xl p-5 border border-white/5 hover:border-[#F0B22B]/20 transition-all">
                        <h3 class="text-sm font-bold text-[#F0B22B] mb-3 uppercase tracking-widest flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 20 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                            Spesifikasi
                        </h3>
                        <div class="text-gray-300 text-sm leading-relaxed text-left italic">
                            <pre class="whitespace-pre-line font-sans text-left">{{ $product->specs }}</pre>
                        </div>
                    </div>
                    @endif
                    
                    {{-- Detail/Deskripsi --}}
                    @if ($product->details)
                    <div class="bg-[#0c0c3d] rounded-2xl p-5 border border-white/5">
                        <h3 class="text-sm font-bold text-[#F0B22B] mb-3 uppercase tracking-widest">Deskripsi</h3>
                        <div class="text-gray-300 text-sm leading-relaxed text-left">
                            {{ $product->details }}
                        </div>
                    </div>
                    @endif
                </div>

                {{-- TOMBOL AKSI --}}
                <div class="mt-auto pt-8">
                    @if($product->stock > 0)
                        @auth
                            @if(auth()->user()->role === 'pengguna')
                                <a href="{{ route('checkout.show', $product->id) }}"
                                    class="w-full bg-[#F0B22B] hover:bg-white text-black font-black py-4 px-4 rounded-xl transition-all duration-300 shadow-[0_0_20px_rgba(240,178,43,0.3)] hover:shadow-[0_0_30px_rgba(240,178,43,0.5)] text-center block text-sm uppercase tracking-widest transform hover:-translate-y-1">
                                    Beli Sekarang
                                </a>
                            @else
                                <button disabled class="w-full bg-white/5 text-gray-500 font-bold py-4 px-4 rounded-xl cursor-not-allowed text-sm uppercase border border-white/10">
                                    Hanya untuk akun pengguna
                                </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                                class="w-full bg-[#003A8F] hover:bg-white hover:text-[#003A8F] text-white font-bold py-4 px-4 rounded-xl transition-all duration-300 shadow-lg text-center block text-sm uppercase tracking-widest border border-white/10 transform hover:-translate-y-1">
                                Login untuk Melanjutkan
                            </a>
                        @endauth
                    @else
                        <button disabled class="w-full bg-red-500/10 text-red-500 font-bold py-4 px-4 rounded-xl cursor-not-allowed text-sm uppercase border border-red-500/20">
                            Stok Habis Terjual
                        </button>
                    @endif
                </div>
            </div>
        </div>

        {{-- PRODUK LAINNYA --}}
        @if(isset($relatedProducts) && count($relatedProducts) > 0)
        <div class="mt-16 pt-10 border-t border-white/10">
            <h2 class="text-xl font-black text-white mb-8 text-left uppercase tracking-widest reveal-item opacity-0 transform translate-y-8 transition-all duration-700">Produk Rekomendasi</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                @foreach($relatedProducts as $related)
                <div class="reveal-item opacity-0 transform translate-y-8 transition-all duration-700 group bg-[#0c0c3d] rounded-2xl overflow-hidden text-white 
                            shadow-lg transition-all duration-300 hover:-translate-y-2 hover:border-[#F0B22B]/20 border border-white/5">
                    
                    <div class="h-32 sm:h-44 bg-gradient-to-b from-[#003A8F] to-[#002a6a] flex items-center justify-center overflow-hidden">
                        <img
                            src="{{ $related->photo ? asset('storage/' . $related->photo) : asset('images/placeholder.png') }}"
                            alt="{{ $related->name }}"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                        />
                    </div>

                    <div class="p-4 flex flex-col h-full">
                        <h3 class="font-bold text-xs sm:text-sm mb-3 leading-tight group-hover:text-[#F0B22B] transition-colors line-clamp-2 text-left">
                            {{ $related->name }}
                        </h3>

                        <div class="mt-auto">
                            <p class="text-[#F0B22B] font-black text-sm mb-3 text-left">
                                Rp {{ number_format($related->price, 0, ',', '.') }}
                            </p>
                            <a href="{{ route('shop.show', $related->id) }}"
                               class="inline-block bg-white/5 hover:bg-[#F0B22B] hover:text-black text-white px-3 py-2
                                      rounded-lg text-[10px] font-bold w-full text-center uppercase tracking-widest
                                      transition-all duration-300">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

{{-- Tombol Kembali Floating --}}
<a href="{{ route('shop.index') }}"
   class="fixed bottom-6 left-6 z-50 inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#0c0c3d]/80 backdrop-blur-md border border-white/10 text-xs font-bold text-gray-200 shadow-2xl hover:border-[#F0B22B] hover:text-[#F0B22B] transition-all duration-300 transform hover:scale-105 active:scale-95">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
    KEMBALI KE TOKO
</a>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const revealItems = document.querySelectorAll('.reveal-item');
        
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const allItems = Array.from(revealItems);
                    const index = allItems.indexOf(entry.target);
                    
                    setTimeout(() => {
                        entry.target.classList.remove('opacity-0', 'translate-y-8');
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                    }, index * 100); 

                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        revealItems.forEach(el => observer.observe(el));
    });
</script>
@endsection