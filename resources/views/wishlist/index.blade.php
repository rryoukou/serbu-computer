@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-[#090069]">

    <div class="bg-gradient-to-b from-[#090069] to-[#0c0c3d] py-14 md:py-18">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal-item opacity-0 transform translate-y-8 transition-all duration-700">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Your <span class="text-[#F0B22B]">Favorite</span> Products
            </h1>
            <p class="text-gray-300">
                Produk favorit yang kamu simpan untuk nanti
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        @if($products->count())
        <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 md:gap-6">

            @foreach ($products as $product)
            <div class="reveal-item opacity-0 transform translate-y-8 transition-all duration-700 group bg-[#0c0c3d] rounded-2xl overflow-hidden text-white 
                        shadow-[0_8px_24px_rgba(0,0,0,0.3)] hover:-translate-y-2 hover:shadow-[0_16px_40px_rgba(240,178,43,0.15)]
                        hover:border hover:border-[#F0B22B]/20 relative">

                <div class="absolute top-2 left-2 md:top-4 md:left-4 z-20">
                    <span class="px-2 py-0.5 md:px-3 md:py-1 text-[7px] md:text-[10px] font-semibold rounded-full {{ $product->category === 'Laptop' ? 'bg-blue-500' : 'bg-green-500' }} text-white uppercase">
                        {{ $product->category }}
                    </span>
                </div>

                <div class="absolute top-2 right-2 md:top-4 md:right-4 z-20">
                    @if($product->stock > 0)
                        <span class="px-2 py-0.5 md:px-3 md:py-1 text-[7px] md:text-[10px] font-semibold rounded-full bg-[#F0B22B] text-black">
                            Stock: {{ $product->stock }}
                        </span>
                    @else
                        <span class="px-2 py-0.5 md:px-3 md:py-1 text-[7px] md:text-[10px] font-semibold rounded-full bg-red-500 text-white">
                            Out
                        </span>
                    @endif
                </div>

                <div class="h-32 md:h-48 bg-gradient-to-b from-[#003A8F] to-[#002a6a] overflow-hidden relative rounded-t-2xl">
                    <img
                        src="{{ $product->photo ? asset('storage/' . $product->photo) : asset('images/placeholder.png') }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                    />
                </div>

                <div class="p-3 md:p-5 grid grid-cols-2 gap-2 md:gap-4 text-xs min-h-[140px] md:min-h-[160px] relative z-10">

                    <div class="flex flex-col">
                        <h3 class="font-semibold text-[10px] md:text-sm mb-1 md:mb-2 leading-snug 
                                   transition-colors duration-300 group-hover:text-[#F0B22B] line-clamp-2">
                            {{ $product->name }}
                        </h3>

                        <div class="mt-auto">
                            <p class="text-gray-300 text-[8px] md:text-[10px] mb-0.5 md:mb-1">starts from :</p>
                            <p class="text-[#F0B22B] text-[9px] md:text-xs font-semibold">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col text-right">
                        <p class="font-semibold mb-1 md:mb-2 text-[9px] md:text-xs transition-colors duration-300 group-hover:text-[#F0B22B]">
                            Spesifikasi
                        </p>

                        @php $specs = preg_split("/\r\n|\n|,/", $product->specs); @endphp

                        <p class="text-gray-400 leading-tight mb-2 md:mb-4 text-[8px] md:text-[10px] line-clamp-2">
                            {{ $specs[0] ?? '' }}<br>
                            {{ $specs[1] ?? '' }}
                        </p>

                        <a href="{{ route('shop.show', $product->id) }}"
                           class="mt-auto inline-block bg-[#F0B22B] text-black px-2 md:px-4 py-1 md:py-1.5 
                                  rounded-full text-[8px] md:text-[10px] self-end font-bold
                                  transition-all duration-300 hover:bg-white hover:scale-105">
                            View Details
                        </a>
                    </div>
                </div>
                
                <div class="absolute top-0 right-0 w-12 h-12 bg-gradient-to-bl from-[#F0B22B]/0 via-[#F0B22B]/0 to-[#F0B22B]/10 rounded-bl-2xl transition-all duration-500 group-hover:from-[#F0B22B]/10 group-hover:to-[#F0B22B]/20"></div>
            </div>
            @endforeach

        </div>

        @else
        <div class="text-center py-20 reveal-item opacity-0 transform translate-y-8 transition-all duration-700">
            <div class="w-20 h-20 bg-[#0c0c3d] rounded-full flex items-center justify-center mx-auto mb-6 border border-white/10 shadow-lg">
                <svg class="w-10 h-10 text-[#F0B22B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-3">
                Wishlist kamu masih kosong
            </h3>
            <p class="text-gray-400 mb-6 text-sm">
                Yuk tambahin produk favoritmu dulu
            </p>
            <a href="{{ route('shop.index') }}"
               class="inline-block bg-[#F0B22B] text-black px-8 py-3
                      rounded-full font-bold hover:bg-white transition-all shadow-lg active:scale-95">
                Jelajahi Produk
            </a>
        </div>
        @endif

    </div>
</div>

<style>
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const revealItems = document.querySelectorAll('.reveal-item');
        
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const allItems = Array.from(revealItems);
                    const index = allItems.indexOf(entry.target);
                    
                    // Efek staggered muncul bergantian
                    setTimeout(() => {
                        entry.target.classList.remove('opacity-0', 'translate-y-8');
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                    }, index * 50); 

                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        revealItems.forEach(el => observer.observe(el));
    });
</script>
@endsection