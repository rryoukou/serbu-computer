@extends('layouts.admin')

@section('page_title', 'Product Management')

@section('content')
<div class="flex flex-col gap-6 px-4 md:px-0">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="text-center md:text-left">
            <h2 class="text-white text-2xl font-bold">Daftar Produk</h2>
            <p class="text-gray-400 text-sm mt-1">
                Total {{ $products->total() }} produk tersedia
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            <form method="GET" action="{{ route('admin.products.index') }}" class="w-full sm:w-auto">
                <input 
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari produk..."
                    class="w-full px-4 py-3 rounded-2xl bg-white/5 border border-white/10 text-white placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-[#F0B22B]"
                >
            </form>

            <a href="{{ route('admin.products.create') }}" 
               class="flex items-center justify-center gap-2 bg-[#F0B22B] text-[#090069] font-bold px-6 py-3 rounded-2xl
                      hover:brightness-110 active:scale-95 transition-all shadow-lg shadow-[#F0B22B]/20">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                      fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                      stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Tambah Produk
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/50 text-green-400 px-6 py-4 rounded-2xl flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                 stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white/5 backdrop-blur-md rounded-[24px] md:rounded-[32px] border border-white/10 overflow-hidden shadow-2xl">
        
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/5">
                        <th class="px-6 py-5 text-[#F0B22B] font-bold uppercase text-xs tracking-wider text-center">Foto</th>
                        <th class="px-6 py-5 text-[#F0B22B] font-bold uppercase text-xs tracking-wider">Info Produk</th>
                        <th class="px-6 py-5 text-[#F0B22B] font-bold uppercase text-xs tracking-wider">Kategori</th>
                        <th class="px-6 py-5 text-[#F0B22B] font-bold uppercase text-xs tracking-wider text-center">Stok</th>
                        <th class="px-6 py-5 text-[#F0B22B] font-bold uppercase text-xs tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($products as $product)
                    <tr class="hover:bg-white/[0.02] transition-colors group">
                        <td class="px-6 py-4">
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
                        <td class="px-6 py-4">
                            <div class="font-bold text-white text-base group-hover:text-[#F0B22B] transition-colors">{{ $product->name }}</div>
                            <div class="text-[#F0B22B] font-semibold text-sm mt-0.5">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-white/5 rounded-full text-gray-300 text-xs font-medium border border-white/10">{{ $product->category }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-bold {{ $product->stock <= 5 ? 'text-red-400' : 'text-white' }}">{{ $product->stock }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}" 
                                   class="inline-flex items-center justify-center p-2.5 bg-yellow-500/10 text-yellow-500 rounded-xl hover:bg-yellow-500 hover:text-[#090069] transition-all shadow-lg shadow-yellow-500/5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center p-2.5 bg-red-500/10 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all shadow-lg shadow-red-500/5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-10 text-gray-400">Produk tidak ditemukan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="md:hidden divide-y divide-white/5">
            @forelse($products as $product)
            <div class="p-5 flex items-center gap-4 group">
                <div class="w-20 h-20 shrink-0 rounded-2xl overflow-hidden border-2 border-white/10 group-hover:border-[#F0B22B]/50 transition-all shadow-lg">
                    @if($product->photo)
                        <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-[#161B33] flex items-center justify-center text-gray-600 text-[10px]">No Image</div>
                    @endif
                </div>

                <div class="flex-grow">
                    <div class="font-bold text-white text-base group-hover:text-[#F0B22B] transition-colors line-clamp-1">{{ $product->name }}</div>
                    <div class="text-[#F0B22B] font-semibold text-sm mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-0.5 bg-white/5 rounded-lg text-gray-400 text-[10px] border border-white/10">{{ $product->category }}</span>
                        <span class="text-[10px] {{ $product->stock <= 5 ? 'text-red-400' : 'text-gray-400' }}">Stok: {{ $product->stock }}</span>
                    </div>
                </div>

                <div class="shrink-0 flex flex-col gap-2">
                    <a href="{{ route('admin.products.edit', $product->id) }}" 
                       class="w-10 h-10 bg-yellow-500/10 text-yellow-500 rounded-xl flex items-center justify-center active:scale-90 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                    </a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin hapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-10 h-10 bg-red-500/10 text-red-500 rounded-xl flex items-center justify-center active:scale-90 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="text-center py-10 text-gray-400">Produk tidak ditemukan</div>
            @endforelse
        </div>
    </div>

    <div class="mt-6 flex justify-center custom-pagination overflow-x-auto pb-4">
        {{ $products->links() }}
    </div>
</div>

<style>
.custom-pagination nav svg { width: 20px; height: 20px; }
.custom-pagination nav div div span,
.custom-pagination nav div div a {
    border-radius: 12px !important;
    background: rgba(255,255,255,0.05) !important;
    color: white !important;
    border-color: rgba(255,255,255,0.1) !important;
    margin: 0 2px;
    padding: 8px 12px !important;
    font-size: 12px;
}
</style>
@endsection