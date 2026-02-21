@extends('layouts.admin')

@section('page_title', 'Add New Product')

@section('content')
<div class="max-w-4xl mx-auto px-4 pb-20">
    
    <div class="mb-8 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.products.index') }}" 
               class="p-2.5 bg-white/5 text-[#F0B22B] rounded-xl hover:bg-[#F0B22B] hover:text-[#090069] transition-all shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            </a>
            <div>
                <h2 class="text-white text-xl md:text-2xl font-bold tracking-tight">Tambah Produk Baru</h2>
                <p class="text-gray-400 text-[10px] md:text-xs uppercase tracking-widest mt-1">Input Stok Terbaru Serbu Comp</p>
            </div>
        </div>
    </div>

    <div class="bg-white/5 backdrop-blur-md rounded-[24px] md:rounded-[28px] border border-white/10 p-5 md:p-8 shadow-2xl">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6">
                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-[10px] md:text-xs font-bold uppercase tracking-wider ml-1">Nama Produk</label>
                    <input type="text" name="name" value="{{ old('name') }}" 
                           class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3 md:py-3.5 text-sm md:text-base text-white focus:outline-none focus:border-[#F0B22B] transition-all" 
                           placeholder="Contoh: Laptop Gaming Nitro 5" required>
                </div>
                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-[10px] md:text-xs font-bold uppercase tracking-wider ml-1">Kategori</label>
                    <div class="relative">
                        <select name="category" class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3 md:py-3.5 text-sm md:text-base text-white focus:outline-none focus:border-[#F0B22B] appearance-none cursor-pointer">
                            <option value="Laptop" class="bg-[#090069]">Laptop</option>
                            <option value="Aksesoris" class="bg-[#090069]">Aksesoris</option>
                        </select>
                        <svg class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-[#F0B22B]" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="m6 9 6 6 6-6"/></svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 md:gap-6">
                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-[10px] md:text-xs font-bold uppercase tracking-wider ml-1">Harga (Rupiah)</label>
                    <div class="relative">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-500 font-bold text-sm">Rp</span>
                        <input type="number" name="price" value="{{ old('price') }}" 
                               class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl pl-12 pr-5 py-3 md:py-3.5 text-sm md:text-base text-white focus:outline-none focus:border-[#F0B22B]" 
                               placeholder="0" required>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-[10px] md:text-xs font-bold uppercase tracking-wider ml-1">Stok Awal</label>
                    <input type="number" name="stock" value="{{ old('stock') }}" 
                           class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3 md:py-3.5 text-sm md:text-base text-white focus:outline-none focus:border-[#F0B22B]" 
                           placeholder="0" required>
                </div>
            </div>

            <div class="space-y-6">
                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-[10px] md:text-xs font-bold uppercase tracking-wider ml-1">Spesifikasi Singkat</label>
                    <textarea name="specs" rows="3" class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3 md:py-3.5 text-sm md:text-base text-white focus:outline-none focus:border-[#F0B22B]" placeholder="Tuliskan spek core produk..."></textarea>
                </div>

                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-[10px] md:text-xs font-bold uppercase tracking-wider ml-1">Detail Lengkap Produk</label>
                    <textarea name="details" rows="4" class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3 md:py-3.5 text-sm md:text-base text-white focus:outline-none focus:border-[#F0B22B]" placeholder="Deskripsikan produk secara detail..."></textarea>
                </div>
            </div>

            <div class="p-5 md:p-6 bg-white/5 rounded-[24px] border border-dashed border-white/20 overflow-hidden">
                <div class="flex flex-col md:flex-row items-center md:items-start gap-4 md:gap-6">
                    <div class="w-16 h-16 md:w-20 md:h-20 bg-[#F0B22B]/10 rounded-2xl flex items-center justify-center text-[#F0B22B] shrink-0 border border-[#F0B22B]/20">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                    </div>
                    <div class="flex-grow w-full text-center md:text-left">
                        <p class="text-white font-bold mb-3 text-sm md:text-base">Unggah Foto Produk</p>
                        <input type="file" name="photo" class="block w-full text-xs md:text-sm text-gray-400
                            file:mr-4 file:py-2 file:px-4 md:file:px-6
                            file:rounded-xl file:border-0
                            file:text-[10px] md:file:text-xs file:font-bold
                            file:bg-[#F0B22B] file:text-[#090069]
                            hover:file:brightness-110 cursor-pointer transition-all" required>
                        <p class="text-[9px] md:text-[10px] text-gray-500 mt-3 uppercase tracking-tighter">*Rekomendasi ukuran 1:1 (Max 2MB)</p>
                    </div>
                </div>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" 
                        class="w-full md:w-auto md:min-w-[200px] px-8 py-3.5 bg-[#F0B22B] text-[#090069] rounded-2xl font-extrabold text-sm md:text-base uppercase tracking-wider hover:brightness-110 active:scale-95 transition-all shadow-xl shadow-[#F0B22B]/20">
                    Publish Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection