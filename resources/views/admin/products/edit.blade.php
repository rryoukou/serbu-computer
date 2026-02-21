@extends('layouts.admin')

@section('page_title', 'Edit Product')

@section('content')
<div class="max-w-4xl mx-auto px-4 pb-20">
    
    <div class="mb-8 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.products.index') }}" 
               class="p-2.5 bg-white/5 text-[#F0B22B] rounded-xl hover:bg-[#F0B22B] hover:text-[#090069] transition-all shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            </a>
            <div>
                <h2 class="text-white text-xl md:text-2xl font-bold tracking-tight">Edit Produk</h2>
                <p class="text-gray-400 text-[10px] md:text-xs uppercase tracking-widest mt-1">Update Inventaris Serbu Comp</p>
            </div>
        </div>
    </div>

    <div class="bg-white/5 backdrop-blur-md rounded-[24px] md:rounded-[28px] border border-white/10 p-5 md:p-8 shadow-2xl">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6">
                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-[10px] md:text-xs font-bold uppercase tracking-wider ml-1">Nama Produk</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" 
                           class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3 md:py-3.5 text-sm md:text-base text-white focus:outline-none focus:border-[#F0B22B] transition-all" 
                           placeholder="Nama laptop/aksesoris">
                </div>
                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-[10px] md:text-xs font-bold uppercase tracking-wider ml-1">Kategori</label>
                    <div class="relative">
                        <select name="category" class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3 md:py-3.5 text-sm md:text-base text-white focus:outline-none focus:border-[#F0B22B] appearance-none cursor-pointer">
                            <option value="Laptop" @selected($product->category == 'Laptop') class="bg-[#090069]">Laptop</option>
                            <option value="Aksesoris" @selected($product->category == 'Aksesoris') class="bg-[#090069]">Aksesoris</option>
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
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" 
                               class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl pl-12 pr-5 py-3 md:py-3.5 text-sm md:text-base text-white focus:outline-none focus:border-[#F0B22B]">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-[10px] md:text-xs font-bold uppercase tracking-wider ml-1">Stok Tersedia</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" 
                           class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3 md:py-3.5 text-sm md:text-base text-white focus:outline-none focus:border-[#F0B22B]">
                </div>
            </div>

            <div class="space-y-6">
                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-[10px] md:text-xs font-bold uppercase tracking-wider ml-1">Spesifikasi Singkat</label>
                    <textarea name="specs" rows="3" class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3 md:py-3.5 text-sm md:text-base text-white focus:outline-none focus:border-[#F0B22B]">{{ old('specs', $product->specs) }}</textarea>
                </div>

                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-[10px] md:text-xs font-bold uppercase tracking-wider ml-1">Detail Produk</label>
                    <textarea name="details" rows="4" class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3 md:py-3.5 text-sm md:text-base text-white focus:outline-none focus:border-[#F0B22B]">{{ old('details', $product->details) }}</textarea>
                </div>
            </div>

            <div class="p-5 md:p-6 bg-white/5 rounded-[24px] border border-dashed border-white/20 overflow-hidden">
                <div class="flex flex-col md:flex-row items-center md:items-start gap-5 md:gap-8">
                    @if($product->photo)
                        <div class="relative group shrink-0">
                            <img src="{{ asset('storage/' . $product->photo) }}" class="w-24 h-24 md:w-32 md:h-32 object-cover rounded-2xl border-2 border-[#F0B22B] shadow-lg transition-transform group-hover:scale-105">
                            <span class="absolute -top-2 -right-2 bg-[#F0B22B] text-[#090069] text-[9px] font-bold px-2 py-0.5 rounded-full shadow-md">AKTIF</span>
                        </div>
                    @endif
                    <div class="flex-grow w-full text-center md:text-left">
                        <p class="text-white font-bold mb-3 text-sm md:text-base">Upload Foto Baru</p>
                        <input type="file" name="photo" class="block w-full text-xs md:text-sm text-gray-400
                            file:mr-4 file:py-2 file:px-4 md:file:px-6
                            file:rounded-xl file:border-0
                            file:text-[10px] md:file:text-xs file:font-bold
                            file:bg-[#F0B22B] file:text-[#090069]
                            hover:file:brightness-110 cursor-pointer transition-all">
                        <p class="text-[9px] md:text-[10px] text-gray-500 mt-3 uppercase tracking-tighter">*Biarkan kosong jika tidak ingin mengganti foto</p>
                    </div>
                </div>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" 
                        class="w-full md:w-auto md:min-w-[200px] px-10 py-3.5 bg-[#F0B22B] text-[#090069] rounded-2xl font-extrabold text-sm md:text-base uppercase tracking-wider hover:brightness-110 active:scale-95 transition-all shadow-xl shadow-[#F0B22B]/20">
                    Update Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection