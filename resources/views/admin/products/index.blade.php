@extends('layouts.admin')

@section('page_title', 'Product Management')

@section('content')
<div class="flex flex-col gap-6">

    <!-- HEADER + SEARCH + ADD BUTTON -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-white text-2xl font-bold">Daftar Produk</h2>
            <p class="text-gray-400 text-sm mt-1">
                Total {{ $products->total() }} produk tersedia
            </p>
        </div>

        <div class="flex gap-3">
            <!-- SEARCH -->
            <form method="GET" action="{{ route('admin.products.index') }}">
                <input 
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari produk..."
                    class="px-4 py-3 rounded-2xl bg-white/5 border border-white/10 text-white placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-[#F0B22B]"
                >
            </form>

            <!-- TAMBAH PRODUK -->
            <a href="{{ route('admin.products.create') }}" 
               class="flex items-center gap-2 bg-[#F0B22B] text-[#090069] font-bold px-6 py-3 rounded-2xl
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

    <!-- SUCCESS ALERT -->
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

    <!-- TABLE -->
    <div class="bg-white/5 backdrop-blur-md rounded-[32px] border border-white/10 overflow-hidden shadow-2xl">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white/5">
                    <th class="px-6 py-5 text-[#F0B22B] font-bold uppercase text-xs tracking-wider">Foto</th>
                    <th class="px-6 py-5 text-[#F0B22B] font-bold uppercase text-xs tracking-wider">Info Produk</th>
                    <th class="px-6 py-5 text-[#F0B22B] font-bold uppercase text-xs tracking-wider">Kategori</th>
                    <th class="px-6 py-5 text-[#F0B22B] font-bold uppercase text-xs tracking-wider text-center">Stok</th>
                    <th class="px-6 py-5 text-[#F0B22B] font-bold uppercase text-xs tracking-wider text-right">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-white/5">
                @forelse($products as $product)
                <tr class="hover:bg-white/[0.02] transition-colors group">
                    <td class="px-6 py-4">
                        <div class="w-16 h-16 rounded-2xl overflow-hidden border-2 border-white/10 group-hover:border-[#F0B22B]/50 transition-all shadow-lg">
                            @if($product->photo)
                                <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-[#161B33] flex items-center justify-center text-gray-600 text-[10px]">
                                    No Image
                                </div>
                            @endif
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        <div class="font-bold text-white text-base group-hover:text-[#F0B22B] transition-colors">
                            {{ $product->name }}
                        </div>
                        <div class="text-[#F0B22B] font-semibold text-sm mt-0.5">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        <span class="px-3 py-1 bg-white/5 rounded-full text-gray-300 text-xs font-medium border border-white/10">
                            {{ $product->category }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-center">
                        <span class="font-bold {{ $product->stock <= 5 ? 'text-red-400' : 'text-white' }}">
                            {{ $product->stock }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" 
                               class="p-2.5 bg-yellow-500/10 text-yellow-500 rounded-xl hover:bg-yellow-500 hover:text-white transition-all shadow-lg shadow-yellow-500/5">
                                ✏️
                            </a>

                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="p-2.5 bg-red-500/10 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all shadow-lg shadow-red-500/5">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-10 text-gray-400">
                        Produk tidak ditemukan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div class="mt-6 flex justify-center custom-pagination">
        {{ $products->links() }}
    </div>
</div>

<style>
.custom-pagination nav svg {
    width: 24px;
    height: 24px;
}
.custom-pagination nav div div span,
.custom-pagination nav div div a {
    border-radius: 12px !important;
    background: rgba(255,255,255,0.05) !important;
    color: white !important;
    border-color: rgba(255,255,255,0.1) !important;
    margin: 0 4px;
}
</style>
@endsection
