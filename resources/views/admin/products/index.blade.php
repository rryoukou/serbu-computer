@extends('layouts.admin')

@section('page_title', 'Product Management')

@section('content')
<div class="space-y-8 px-4 md:px-0">
    {{-- BARIS 1: JUDUL & HEADER --}}
    <div>
        <h2 class="text-white text-2xl font-bold tracking-tight">Product Management</h2>
        <p class="text-gray-400 text-sm mt-1 uppercase tracking-widest">
            Katalog Produk Serbu Comp
        </p>
    </div>

    {{-- BARIS 2: SEARCH, SHOW PER PAGE & BUTTON --}}
    <div class="flex flex-col lg:flex-row items-center justify-between gap-4 bg-white/5 p-4 rounded-[28px] border border-white/10 shadow-2xl backdrop-blur-md">
        
        {{-- FORM FILTER --}}
        <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
            {{-- SELECT SHOW PER PAGE --}}
            <select name="per_page" onchange="this.form.submit()" class="bg-[#090069] border border-white/10 rounded-xl px-3 py-2.5 text-sm text-white focus:border-[#F0B22B] focus:outline-none transition-all cursor-pointer w-full sm:w-auto">
                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>Show 5</option>
                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>Show 10</option>
                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>Show 25</option>
                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>Show 50</option>
            </select>

            {{-- SEARCH INPUT --}}
            <div class="relative w-full sm:w-80">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama produk, kategori, dll..."
                    class="w-full bg-[#090069] border border-white/10 rounded-xl pl-10 pr-4 py-2.5 text-sm text-white focus:border-[#F0B22B] focus:outline-none transition-all"
                >
                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </div>
            </div>
        </form>

        <div class="flex flex-wrap items-center justify-center gap-4 w-full lg:w-auto">
            {{-- TOTAL INFO --}}
            <div class="flex items-center gap-3 bg-[#F0B22B]/10 px-4 py-2 rounded-xl border border-[#F0B22B]/20">
                <span class="w-2 h-2 rounded-full bg-[#F0B22B] animate-pulse"></span>
                <span class="text-[#F0B22B] text-xs font-bold uppercase tracking-wider">
                    {{ $products->total() }} Produk
                </span>
            </div>

            {{-- TOMBOL TAMBAH --}}
            <a href="{{ route('admin.products.create') }}" 
               class="flex items-center gap-2 bg-[#F0B22B] text-[#090069] font-black uppercase text-[10px] tracking-widest px-6 py-2.5 rounded-xl hover:scale-105 active:scale-95 transition-all shadow-lg shadow-[#F0B22B]/20">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Tambah Produk
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/50 text-green-400 px-6 py-4 rounded-2xl flex items-center gap-3 animate-pulse">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
    @endif

    {{-- TABLE SECTION --}}
    <div class="bg-white/5 backdrop-blur-md rounded-[32px] border border-white/10 overflow-hidden shadow-2xl">
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/5">
                        <th class="px-8 py-6 text-[#F0B22B] font-black uppercase text-[10px] tracking-[0.2em] text-center">Foto</th>
                        <th class="px-8 py-6 text-[#F0B22B] font-black uppercase text-[10px] tracking-[0.2em]">Info Produk</th>
                        <th class="px-8 py-6 text-[#F0B22B] font-black uppercase text-[10px] tracking-[0.2em]">Kategori</th>
                        <th class="px-8 py-6 text-[#F0B22B] font-black uppercase text-[10px] tracking-[0.2em] text-center">Stok</th>
                        <th class="px-8 py-6 text-[#F0B22B] font-black uppercase text-[10px] tracking-[0.2em] text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($products as $product)
                    <tr class="hover:bg-white/[0.02] transition-colors group">
                        <td class="px-8 py-5">
                            <div class="flex justify-center">
                                <div class="w-16 h-16 rounded-2xl overflow-hidden border-2 border-white/10 group-hover:border-[#F0B22B]/50 transition-all shadow-lg">
                                    @if($product->photo)
                                        <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-[#161B33] flex items-center justify-center text-gray-600 text-[10px]">No Image</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <div class="font-bold text-white text-base group-hover:text-[#F0B22B] transition-colors">{{ $product->name }}</div>
                            <div class="text-[#F0B22B] font-black italic text-sm mt-0.5">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="px-3 py-1 bg-white/5 rounded-full text-gray-400 text-[10px] font-black uppercase tracking-widest border border-white/10">{{ $product->category }}</span>
                        </td>
                        <td class="px-8 py-5 text-center">
                            <span class="font-black {{ $product->stock <= 5 ? 'text-red-400 animate-pulse' : 'text-white' }}">{{ $product->stock }}</span>
                        </td>
                        <td class="px-8 py-5 text-center">
                            <a href="{{ route('admin.products.edit', $product->id) }}" 
                               class="inline-flex items-center justify-center w-10 h-10 bg-yellow-500/10 text-yellow-500 rounded-xl hover:bg-yellow-500 hover:text-[#090069] transition-all shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-20 text-gray-500 font-medium">Produk tidak ditemukan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- MOBILE VIEW --}}
        <div class="md:hidden divide-y divide-white/5">
            @forelse($products as $product)
            <div class="p-6 flex items-center gap-5 group">
                <div class="w-20 h-20 shrink-0 rounded-2xl overflow-hidden border-2 border-white/10 group-hover:border-[#F0B22B]/50 transition-all">
                    @if($product->photo)
                        <img src="{{ asset('storage/' . $product->photo) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-[#161B33] flex items-center justify-center text-gray-600 text-[8px]">No Image</div>
                    @endif
                </div>
                <div class="flex-grow space-y-1">
                    <div class="font-bold text-white group-hover:text-[#F0B22B] transition-colors line-clamp-1">{{ $product->name }}</div>
                    <div class="text-[#F0B22B] font-black text-xs italic">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    <div class="flex items-center gap-2 pt-1">
                        <span class="text-[9px] font-bold text-gray-500 uppercase">{{ $product->category }}</span>
                        <span class="text-[9px] font-bold {{ $product->stock <= 5 ? 'text-red-400' : 'text-gray-400' }}">Stock: {{ $product->stock }}</span>
                    </div>
                </div>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="w-10 h-10 bg-yellow-500/10 text-yellow-500 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </a>
            </div>
            @empty
            <div class="p-10 text-center text-gray-500 text-sm">Produk tidak ditemukan</div>
            @endforelse
        </div>
    </div>

    {{-- PAGINATION NAVIGATION (Gaya Transaction) --}}
    @if ($products->hasPages())
        <div class="mt-10 flex justify-center custom-pagination overflow-x-auto pb-4">
            {{ $products->appends(['per_page' => request('per_page'), 'search' => request('search')])->links() }}
        </div>
    @endif
</div>

<style>
/* Custom Pagination Styling */
.custom-pagination nav svg { width: 20px; height: 20px; }
.custom-pagination nav div div span, 
.custom-pagination nav div div a {
    border-radius: 12px !important;
    background: rgba(255, 255, 255, 0.05) !important;
    color: white !important;
    border-color: rgba(255, 255, 255, 0.1) !important;
    margin: 0 2px;
    padding: 8px 16px !important;
    font-size: 12px;
}
.custom-pagination nav div div a:hover {
    background: rgba(240, 178, 43, 0.2) !important;
    color: #F0B22B !important;
    border-color: #F0B22B !important;
}
.custom-pagination nav div div span[aria-current="page"] > span {
    background: #F0B22B !important;
    color: #090069 !important;
    border-radius: 12px;
    font-weight: 900;
}
</style>
@endsection