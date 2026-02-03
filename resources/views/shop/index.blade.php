@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-[#090069]">
    <!-- Hero Section Simple -->
    <div class="bg-gradient-to-b from-[#090069] to-[#0c0c3d] py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 reveal">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">
                    Our <span class="text-[#F0B22B]">Products</span>
                </h1>
                <p class="text-gray-300 text-base md:text-lg">
                    Temukan laptop dan aksesori komputer terbaik
                </p>
            </div>

            <!-- Category & Sort Bar - Side by Side -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 reveal">
                <!-- Category Buttons -->
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('shop.index') }}" 
                       class="px-4 py-2 rounded-full {{ !$category ? 'bg-[#F0B22B] text-black' : 'bg-white/10 text-white hover:bg-white/20' }} transition-colors font-medium text-sm md:text-base">
                        All
                    </a>
                    <a href="{{ route('shop.index', ['category' => 'Laptop']) }}" 
                       class="px-4 py-2 rounded-full {{ $category == 'Laptop' ? 'bg-[#F0B22B] text-black' : 'bg-white/10 text-white hover:bg-white/20' }} transition-colors font-medium text-sm md:text-base">
                        Laptops
                    </a>
                    <a href="{{ route('shop.index', ['category' => 'Aksesoris']) }}" 
                       class="px-4 py-2 rounded-full {{ $category == 'Aksesoris' ? 'bg-[#F0B22B] text-black' : 'bg-white/10 text-white hover:bg-white/20' }} transition-colors font-medium text-sm md:text-base">
                        Accessories
                    </a>
                </div>

                <!-- Sort & Search -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 w-full sm:w-auto">
                    <!-- Search Box -->
                    <form action="{{ route('shop.index') }}" method="GET" class="relative w-full sm:w-auto">
                        <input type="text" 
                               name="search" 
                               value="{{ $search }}"
                               placeholder="Search products..." 
                               class="w-full sm:w-48 pl-4 pr-10 py-2 bg-white/10 border border-white/20 rounded-full text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#F0B22B] focus:border-transparent text-sm">
                        <button type="submit" class="absolute right-3 top-2.5 text-[#F0B22B]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                        @if($category)
                            <input type="hidden" name="category" value="{{ $category }}">
                        @endif
                    </form>

                    <!-- Sort Dropdown -->
                    <div class="relative">
                        <select id="sortSelect" 
                                class="w-full sm:w-48 px-4 py-2 bg-[#0c0c3d] border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#F0B22B] focus:border-transparent text-sm appearance-none">
                            <option value="newest">Sort: Newest</option>
                            <option value="price-low">Sort: Price Low to High</option>
                            <option value="price-high">Sort: Price High to Low</option>
                            <option value="name">Sort: Name A-Z</option>
                        </select>
                        <!-- Custom Dropdown Arrow -->
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-[#F0B22B]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Filters (if any) -->
            @if($category || $search)
            <div class="mb-6 reveal">
                <div class="flex flex-wrap gap-2 items-center">
                    <span class="text-gray-400 text-sm">Active filters:</span>
                    @if($category)
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs bg-[#F0B22B] text-black font-medium">
                        {{ $category }}
                        <a href="{{ route('shop.index', ['search' => $search]) }}" class="ml-1.5 hover:text-red-600 transition-colors">
                            ×
                        </a>
                    </span>
                    @endif
                    @if($search)
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs bg-[#F0B22B] text-black font-medium">
                        Search: "{{ $search }}"
                        <a href="{{ route('shop.index', ['category' => $category]) }}" class="ml-1.5 hover:text-red-600 transition-colors">
                            ×
                        </a>
                    </span>
                    @endif
                    @if($category || $search)
                    <a href="{{ route('shop.index') }}" 
                       class="text-[#F0B22B] hover:text-white text-sm ml-2 font-medium">
                        Clear all
                    </a>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Products Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Products Count -->
        <div class="mb-6 reveal">
            <p class="text-gray-300">
                @if($category)
                    Showing {{ $products->total() }} {{ strtolower($category) }}(s)
                @else
                    Showing {{ $products->total() }} products
                @endif
            </p>
        </div>

        <!-- Products Grid -->
        @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($products as $index => $product)
            <div class="group bg-[#0c0c3d] rounded-2xl overflow-hidden text-white 
                       shadow-[0_8px_24px_rgba(0,0,0,0.3)]
                       transition-all duration-500 
                       hover:-translate-y-2 hover:shadow-[0_16px_40px_rgba(240,178,43,0.15)]
                       hover:border hover:border-[#F0B22B]/20
                       relative before:absolute before:inset-0 
                       before:bg-gradient-to-br before:from-transparent before:via-transparent 
                       before:to-[#F0B22B]/5 before:opacity-0 before:transition-opacity 
                       before:duration-500 hover:before:opacity-100
                       reveal" style="transition-delay: {{ min($index * 100, 500) }}ms;">

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

        <!-- Simple Pagination -->
        @if($products->hasPages())
        <div class="mt-8 md:mt-12 flex justify-center reveal">
            <div class="flex items-center gap-2">
                @if(!$products->onFirstPage())
                <a href="{{ $products->previousPageUrl() }}" 
                   class="px-3 md:px-4 py-1.5 md:py-2 bg-[#0c0c3d] border border-gray-700 rounded-lg text-white 
                          hover:bg-gray-800 hover:text-[#F0B22B] transition-colors text-sm">
                    ← Previous
                </a>
                @endif

                <span class="px-3 md:px-4 py-1.5 md:py-2 bg-[#0c0c3d] border border-gray-700 rounded-lg text-[#F0B22B] text-sm font-medium">
                    Page {{ $products->currentPage() }} of {{ $products->lastPage() }}
                </span>

                @if($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}" 
                   class="px-3 md:px-4 py-1.5 md:py-2 bg-[#0c0c3d] border border-gray-700 rounded-lg text-white 
                          hover:bg-gray-800 hover:text-[#F0B22B] transition-colors text-sm">
                    Next →
                </a>
                @endif
            </div>
        </div>
        @endif

        @else
        <!-- No Products -->
        <div class="text-center py-12 md:py-16 reveal">
            <div class="w-16 h-16 md:w-20 md:h-20 bg-[#0c0c3d] rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 md:w-10 md:h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-lg md:text-xl font-semibold text-white mb-2">No products found</h3>
            <p class="text-gray-400 text-sm md:text-base mb-4 max-w-md mx-auto">
                @if($category || $search)
                    Try different filters or search terms
                @else
                    Check back soon for new products
                @endif
            </p>
            @if($category || $search)
            <a href="{{ route('shop.index') }}" 
               class="inline-block bg-[#F0B22B] text-black px-5 md:px-6 py-2 md:py-2.5 rounded-lg font-medium hover:bg-white transition-colors text-sm md:text-base">
                Clear Filters
            </a>
            @endif
        </div>
        @endif
    </div>
</div>

<script>
    // Set sort select value and handle change
    document.addEventListener('DOMContentLoaded', function() {
        const sortSelect = document.getElementById('sortSelect');
        if (sortSelect) {
            // Get current sort from URL
            const urlParams = new URLSearchParams(window.location.search);
            const currentSort = urlParams.get('sort') || 'newest';
            
            // Set the selected value
            sortSelect.value = currentSort;
            
            // Handle sort change
            sortSelect.addEventListener('change', function() {
                // Get current URL
                let url = new URL(window.location.href);
                
                // Update or add sort parameter
                if (this.value === 'newest') {
                    url.searchParams.delete('sort');
                } else {
                    url.searchParams.set('sort', this.value);
                }
                
                // Navigate to new URL
                window.location.href = url.toString();
            });
        }
        
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
    
    /* Custom select styling */
    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23F0B22B' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    
    /* Hide default dropdown arrow in Firefox */
    select::-ms-expand {
        display: none;
    }
    
    /* Better mobile spacing */
    @media (max-width: 640px) {
        .grid-cols-2 {
            grid-template-columns: 1fr;
        }
        
        .flex-col.sm\:flex-row {
            gap: 12px;
        }
    }
</style>
@endsection