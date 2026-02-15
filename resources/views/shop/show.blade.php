@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-[#090069] py-6">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- GAMBAR PRODUK --}}
            <div class="relative group"> 
                {{-- Container Foto Kotak --}}
                <div class="bg-gradient-to-b from-[#003A8F] to-[#002a6a] rounded-2xl p-4 shadow-2xl overflow-hidden aspect-square flex items-center justify-center">
                    <div class="bg-gradient-to-b from-[#001f4d] to-[#001536] rounded-xl overflow-hidden w-full h-full flex items-center justify-center">
                        <img
                            src="{{ $product->photo ? asset('storage/' . $product->photo) : 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?auto=format&fit=crop&w=600' }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                </div>

                @php
                    $isWishlisted = session('wishlist') && isset(session('wishlist')[$product->id]);
                @endphp

                <div class="absolute top-6 right-6 z-20">
                    <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="transition-transform duration-300 hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 transition-all duration-300 {{ $isWishlisted ? 'fill-[#F0B22B]' : 'fill-none stroke-white' }}" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3 9.24 3 10.91 3.81 12 5.08 13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5 22 12.28 18.6 15.36 13.45 20.04 L12 21.35z"/>
                            </svg>
                        </button>
                    </form>
                </div>

                {{-- CATEGORY --}}
                <div class="mt-4">
                    <span class="inline-block px-4 py-1.5 bg-[#F0B22B] text-black font-semibold rounded-full text-sm">
                        {{ $product->category ?? 'Produk' }}
                    </span>
                </div>
            </div>

            {{-- DETAIL PRODUK --}}
            <div class="text-white">
                {{-- Nama Produk --}}
                <div class="mb-6">
                    <h1 class="text-2xl md:text-3xl font-bold text-left">{{ $product->name }}</h1>
                </div>

                {{-- Harga dan Status --}}
                <div class="mb-6 p-4 md:p-5 bg-[#0c0c3d] rounded-xl border border-gray-800">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-3 space-y-3 md:space-y-0">
                        <div class="text-left">
                            <p class="text-gray-400 text-sm mb-1">Harga:</p>
                            <p class="text-xl md:text-2xl font-bold text-[#F0B22B]">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>
                        
                        <div class="text-left md:text-right">
                            <p class="text-gray-400 text-sm mb-1">Status:</p>
                            @if ($product->stock > 0)
                                <span class="inline-block px-3 py-1 bg-green-500 text-white font-semibold rounded-full text-sm">
                                    Tersedia
                                </span>
                            @else
                                <span class="inline-block px-3 py-1 bg-red-500 text-white font-semibold rounded-full text-sm">
                                    Habis
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pt-3 border-t border-gray-800 space-y-2 sm:space-y-0">
                        <div class="text-gray-400 text-sm">
                            Stok: <span class="text-white font-semibold">{{ $product->stock }} unit</span>
                        </div>
                        @if($product->stock > 0 && $product->stock <= 5)
                        <div class="text-orange-400 text-xs font-medium bg-orange-900/30 px-2 py-1 rounded-full">
                            ⚠️ Hampir habis!
                        </div>
                        @endif
                    </div>
                </div>

                {{-- INFORMASI DETAIL --}}
                <div class="space-y-4">
                    {{-- Spesifikasi --}}
                    @if ($product->specs)
                    <div class="bg-[#0c0c3d] rounded-xl p-4 md:p-5 border border-gray-800">
                        <h3 class="text-lg font-bold text-white mb-3 pb-2 border-b border-gray-800 text-left">Spesifikasi</h3>
                        <div class="text-gray-300 text-sm leading-relaxed text-left">
                            <pre class="whitespace-pre-line font-sans text-left">{{ $product->specs }}</pre>
                        </div>
                    </div>
                    @endif
                    
                    {{-- Detail --}}
                    @if ($product->details)
                    <div class="bg-[#0c0c3d] rounded-xl p-4 md:p-5 border border-gray-800">
                        <h3 class="text-lg font-bold text-white mb-3 pb-2 border-b border-gray-800 text-left">Deskripsi Produk</h3>
                        <div class="text-gray-300 text-sm leading-relaxed text-left">
                            {{ $product->details }}
                        </div>
                    </div>
                    @endif
                    
                    {{-- Panduan Pembelian --}}
                    @if ($product->purchase_guide)
                    <div class="bg-[#0c0c3d] rounded-xl p-4 md:p-5 border border-gray-800">
                        <h3 class="text-lg font-bold text-white mb-3 pb-2 border-b border-gray-800 text-left">Panduan Pembelian</h3>
                        <div class="text-gray-300 text-sm leading-relaxed text-left">
                            {{ $product->purchase_guide }}
                        </div>
                    </div>
                    @endif
                </div>

                {{-- TOMBOL AKSI (PINDAH KE PALING BAWAH) --}}
                <div class="mt-8">
                    @if($product->stock > 0)
                        @auth
                            @if(auth()->user()->role === 'pengguna')
                                <a href="{{ route('checkout.show', $product->id) }}"
                                    class="w-full bg-gradient-to-r from-[#F0B22B] to-[#e0a020] hover:from-[#ffc233] hover:to-[#f0b22b] text-black font-bold py-4 px-4 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl text-center block text-sm uppercase tracking-wider">
                                    Beli Sekarang
                                </a>
                            @else
                                <button disabled class="w-full bg-gray-700 text-gray-400 font-medium py-4 px-4 rounded-lg cursor-not-allowed text-sm uppercase">
                                    Hanya untuk pengguna
                                </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                                class="w-full bg-gradient-to-r from-[#003A8F] to-[#002a6a] hover:from-[#0048b3] hover:to-[#003a8f] text-white font-medium py-4 px-4 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl border border-blue-700/50 text-center block text-sm uppercase">
                                Login untuk Beli
                            </a>
                        @endauth
                    @else
                        <button disabled class="w-full bg-gray-700 text-gray-400 font-medium py-4 px-4 rounded-lg cursor-not-allowed text-sm uppercase">
                            Stok Habis
                        </button>
                    @endif
                </div>
            </div>
        </div>

        {{-- PRODUK LAINNYA --}}
        @if(isset($relatedProducts) && count($relatedProducts) > 0)
        <div class="mt-10 md:mt-12 pt-8 md:pt-10 border-t border-gray-800">
            <h2 class="text-lg md:text-xl font-bold text-white mb-4 md:mb-6 text-left">Produk Lainnya</h2>
            <div class="grid grid-cols-1 xs:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4">
                @foreach($relatedProducts as $related)
                <div class="group bg-[#0c0c3d] rounded-xl overflow-hidden text-white 
                            shadow-[0_2px_8px_rgba(0,0,0,0.3)]
                            transition-all duration-300 
                            hover:-translate-y-1 hover:shadow-[0_6px_20px_rgba(240,178,43,0.15)]
                            hover:border hover:border-[#F0B22B]/20">
                    {{-- Stock Badge --}}
                    <div class="absolute top-2 right-2 z-20">
                        @if($related->stock > 0)
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-[#F0B22B] text-black">
                            {{ $related->stock }}
                        </span>
                        @else
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-500 text-white">
                            Habis
                        </span>
                        @endif
                    </div>

                    {{-- IMAGE --}}
                    <div class="h-32 sm:h-36 bg-gradient-to-b from-[#003A8F] to-[#002a6a] 
                                flex items-center justify-center overflow-hidden">
                        <img
                            src="{{ $related->photo 
                                ? asset('storage/' . $related->photo)
                                : 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?auto=format&fit=crop&w=400' }}"
                            alt="{{ $related->name }}"
                            class="h-full object-contain transition-transform duration-300 group-hover:scale-105"
                        />
                    </div>

                    {{-- CONTENT --}}
                    <div class="p-3 sm:p-4">
                        <div class="mb-2">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full 
                                         {{ $related->category == 'Laptop' ? 'bg-blue-500' : 'bg-green-500' }} 
                                         text-white">
                                {{ $related->category }}
                            </span>
                        </div>

                        <h3 class="font-semibold text-xs sm:text-sm mb-2 leading-snug 
                                   transition-colors duration-300 
                                   group-hover:text-[#F0B22B] line-clamp-2 text-left">
                            {{ Str::limit($related->name, 40) }}
                        </h3>

                        <div class="mb-2 sm:mb-3">
                            <p class="text-gray-300 text-xs mb-1 text-left">Harga:</p>
                            <p class="text-[#F0B22B] font-semibold text-xs sm:text-sm text-left">
                                Rp {{ number_format($related->price, 0, ',', '.') }}
                            </p>
                        </div>

                        <a href="{{ route('shop.show', $related->id) }}"
                           class="inline-block bg-[#F0B22B] text-black px-3 py-1.5
                                  rounded-lg text-xs font-medium w-full text-center
                                  transition-all duration-300 
                                  hover:bg-white hover:scale-[1.02]">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<a href="{{ route('shop.index') }}"
   class="fixed bottom-4 left-4 z-50
          inline-flex items-center gap-2
          px-4 py-2 rounded-full
          bg-[#0c0c3d] border border-gray-700
          text-sm font-medium text-gray-200
          shadow-lg
          hover:border-[#F0B22B] hover:text-[#F0B22B]
          transition-all duration-300">
    ← Kembali
</a>
@endsection