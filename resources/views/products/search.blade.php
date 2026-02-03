@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-[#090069]">
    <!-- Simple Search Section -->
    <div class="bg-gradient-to-b from-[#090069] to-[#0c0c3d] py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Search <span class="text-[#F0B22B]">Products</span>
                </h1>
                <p class="text-gray-300">
                    Temukan laptop dan aksesoris yang sesuai kebutuhan Anda
                </p>
            </div>

            <!-- Search Form -->
            <div class="max-w-2xl mx-auto">
                <form method="GET" action="{{ route('shop.search.results') }}" 
                      class="flex">
                    <div class="relative flex-1">
                        <input 
                            type="text" 
                            name="q" 
                            value="{{ $keyword ?? '' }}"
                            placeholder="Cari produk berdasarkan nama, spesifikasi, atau kategori..."
                            class="w-full px-6 py-4 bg-white/10 border border-white/20 rounded-l-full text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#F0B22B] focus:border-transparent text-sm md:text-base"
                        >
                    </div>
                    <button type="submit" 
                            class="bg-[#F0B22B] text-black px-8 rounded-r-full font-semibold hover:bg-white transition-colors">
                        Search
                    </button>
                </form>
                
                <!-- Search Info -->
                @if(isset($keyword) && $keyword)
                <div class="text-center mt-6">
                    <p class="text-gray-300">
                        Hasil pencarian untuk:
                        <span class="font-semibold text-[#F0B22B]">
                            "{{ $keyword }}"
                        </span>
                    </p>
                    @if(isset($products) && $products->count() > 0)
                    <p class="text-gray-400 text-sm mt-1">
                        {{ $products->total() }} produk ditemukan
                    </p>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Results Section -->
    @if(isset($keyword) && $keyword)
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if($products->count() > 0)
            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($products as $product)
                <div class="group bg-[#0c0c3d] rounded-2xl overflow-hidden text-white 
                           shadow-[0_8px_24px_rgba(0,0,0,0.3)]
                           transition-all duration-500 
                           hover:-translate-y-2 hover:shadow-[0_16px_40px_rgba(240,178,43,0.15)]
                           hover:border hover:border-[#F0B22B]/20
                           relative before:absolute before:inset-0 
                           before:bg-gradient-to-br before:from-transparent before:via-transparent 
                           before:to-[#F0B22B]/5 before:opacity-0 before:transition-opacity 
                           before:duration-500 hover:before:opacity-100">

                    <!-- Category Badge -->
                    <div class="absolute top-4 left-4 z-20">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                     {{ $product->category == 'Laptop' ? 'bg-blue-500' : 'bg-green-500' }} 
                                     text-white">
                            {{ $product->category }}
                        </span>
                    </div>

                    <!-- Stock Badge -->
                    @if($product->stock > 0)
                    <div class="absolute top-4 right-4 z-20">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-[#F0B22B] text-black">
                            Stock: {{ $product->stock }}
                        </span>
                    </div>
                    @else
                    <div class="absolute top-4 right-4 z-20">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-500 text-white">
                            Out of Stock
                        </span>
                    </div>
                    @endif

                    <!-- IMAGE -->
                    <div class="h-48 bg-gradient-to-b from-[#003A8F] to-[#002a6a] 
            overflow-hidden relative rounded-t-2xl">
    <img
        src="{{ $product->photo 
            ? asset('storage/' . $product->photo)
            : asset('images/placeholder.png') }}"
        alt="{{ $product->name }}"
        class="w-full h-full object-cover"
    />
</div>

                    <!-- CONTENT -->
                    <div class="p-5 grid grid-cols-2 gap-4 text-xs min-h-[160px] relative z-10">

                        <!-- LEFT -->
                        <div class="flex flex-col">
                            <h3 class="font-semibold text-sm mb-2 leading-snug 
                                       transition-colors duration-300 
                                       group-hover:text-[#F0B22B]">
                                {{ $product->name }}
                            </h3>

                            <!-- "starts from" di atas harga -->
                            <div class="mt-auto">
                                <p class="text-gray-300 text-xs mb-1">starts from :</p>
                                <p class="text-[#F0B22B] font-semibold
                                          transition-transform duration-300 
                                          group-hover:scale-105 group-hover:translate-x-1">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        <!-- RIGHT -->
                        <div class="flex flex-col text-right">
                            <p class="font-semibold mb-2 transition-colors duration-300 
                                      group-hover:text-[#F0B22B]">
                                Spesifikasi
                            </p>

                            @php
                                $specs = preg_split("/\r\n|\n|,/", $product->specs);
                            @endphp

                            <p class="text-gray-300 leading-snug mb-4">
                                {{ $specs[0] ?? '' }}<br>
                                {{ $specs[1] ?? '' }}
                            </p>

                            <a href="{{ route('shop.show', $product->id) }}"
                               class="mt-auto inline-block bg-[#F0B22B] text-black px-4 py-1
                                      rounded-full text-xs self-end font-medium
                                      transition-all duration-300 
                                      hover:bg-white hover:scale-105 hover:shadow-lg
                                      hover:shadow-[#F0B22B]/30
                                      relative overflow-hidden
                                      after:absolute after:inset-0 
                                      after:bg-gradient-to-r after:from-white/10 
                                      after:to-transparent after:translate-x-[-100%]
                                      hover:after:translate-x-100 after:transition-transform 
                                      after:duration-500">
                                View Details
                            </a>
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

            <!-- Pagination -->
            @if($products->hasPages())
            <div class="mt-12 flex justify-center">
                <div class="flex items-center gap-2">
                    @if(!$products->onFirstPage())
                    <a href="{{ $products->previousPageUrl() }}" 
                       class="px-4 py-2 bg-[#0c0c3d] border border-gray-700 rounded-lg text-white 
                              hover:bg-gray-800 hover:text-[#F0B22B] transition-colors text-sm">
                        ← Previous
                    </a>
                    @endif

                    <span class="px-4 py-2 bg-[#0c0c3d] border border-gray-700 rounded-lg text-[#F0B22B] text-sm font-medium">
                        Page {{ $products->currentPage() }} of {{ $products->lastPage() }}
                    </span>

                    @if($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" 
                       class="px-4 py-2 bg-[#0c0c3d] border border-gray-700 rounded-lg text-white 
                              hover:bg-gray-800 hover:text-[#F0B22B] transition-colors text-sm">
                        Next →
                    </a>
                    @endif
                </div>
            </div>
            @endif

        @else
            <!-- No Results -->
            <div class="text-center py-16">
                <div class="w-20 h-20 bg-[#0c0c3d] rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-white mb-3">
                    Tidak ditemukan produk
                </h3>
                <p class="text-gray-400 mb-6 max-w-md mx-auto">
                    Tidak ada produk yang cocok dengan pencarian 
                    <span class="text-[#F0B22B]">"{{ $keyword }}"</span>
                </p>
                <a href="{{ route('shop.index') }}" 
                   class="inline-block bg-[#F0B22B] text-black px-6 py-2.5 rounded-lg font-medium hover:bg-white transition-colors">
                    Lihat Semua Produk
                </a>
            </div>
        @endif
    </div>
    @endif
</div>
@endsection