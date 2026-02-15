@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-[#090069]">

    <!-- Header Section -->
    <div class="bg-gradient-to-b from-[#090069] to-[#0c0c3d] py-14 md:py-18">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Your <span class="text-[#F0B22B]">Favorite</span> Products
            </h1>
            <p class="text-gray-300">
                Produk favorit yang kamu simpan untuk nanti
            </p>
        </div>
    </div>

    <!-- Content Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        @if($products->count())

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            @foreach ($products as $product)
            <!-- CARD -->
            <div class="group bg-[#0c0c3d] rounded-2xl overflow-hidden text-white
                        shadow-[0_8px_24px_rgba(0,0,0,0.3)]
                        transition-all duration-500
                        hover:-translate-y-2 hover:shadow-[0_16px_40px_rgba(240,178,43,0.15)]
                        hover:border hover:border-[#F0B22B]/20
                        relative">

                <!-- CATEGORY BADGE -->
                <div class="absolute top-4 left-4 z-20">
                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                        {{ $product->category === 'Laptop' ? 'bg-blue-500' : 'bg-green-500' }} text-white">
                        {{ $product->category }}
                    </span>
                </div>

                <!-- STOCK BADGE -->
                <div class="absolute top-4 right-4 z-20">
                    @if($product->stock > 0)
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-[#F0B22B] text-black">
                            Stock: {{ $product->stock }}
                        </span>
                    @else
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-500 text-white">
                            Out of Stock
                        </span>
                    @endif
                </div>

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
                <div class="p-5 grid grid-cols-2 gap-4 text-xs min-h-[160px]">

                    <!-- LEFT -->
                    <div class="flex flex-col">
                        <h3 class="font-semibold text-sm mb-2 leading-snug
                                   transition-colors duration-300
                                   group-hover:text-[#F0B22B]">
                            {{ $product->name }}
                        </h3>

                        <div class="mt-auto">
                            <p class="text-gray-300 text-xs mb-1">starts from :</p>
                            <p class="text-[#F0B22B] font-semibold">
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
                                  hover:shadow-[#F0B22B]/30">
                            View Details
                        </a>
                    </div>

                </div>
            </div>
            @endforeach

        </div>

        @else
        <!-- EMPTY STATE -->
        <div class="text-center py-20">
            <div class="w-20 h-20 bg-[#0c0c3d] rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5
                             2 5.42 4.42 3 7.5 3
                             c1.74 0 3.41.81 4.5 2.09
                             C13.09 3.81 14.76 3 16.5 3
                             19.58 3 22 5.42 22 8.5
                             c0 3.78-3.4 6.86-8.55 11.18L12 21.35z"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-white mb-3">
                Wishlist kamu masih kosong
            </h3>
            <p class="text-gray-400 mb-6">
                Yuk tambahin produk favoritmu dulu
            </p>
            <a href="{{ route('shop.index') }}"
               class="inline-block bg-[#F0B22B] text-black px-6 py-2.5
                      rounded-lg font-medium hover:bg-white transition-colors">
                Jelajahi Produk
            </a>
        </div>
        @endif

    </div>
</div>
@endsection