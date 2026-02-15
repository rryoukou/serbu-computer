@extends('layouts.admin')

@section('page_title', 'Edit Product')

@section('content')
<div class="max-w-4xl mx-auto px-4 pb-10">
    
    <div class="mb-8 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.products.index') }}" 
               class="p-2.5 bg-white/5 text-[#F0B22B] rounded-xl hover:bg-[#F0B22B] hover:text-[#090069] transition-all shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            </a>
            <div>
                <h2 class="text-white text-2xl font-bold tracking-tight">Edit Produk</h2>
                <p class="text-gray-400 text-xs uppercase tracking-widest mt-1">Update Inventaris Serbu Comp</p>
            </div>
        </div>
    </div>

    <div class="bg-white/5 backdrop-blur-md rounded-[28px] border border-white/10 p-8 shadow-2xl">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-xs font-bold uppercase tracking-wider ml-1">Nama Produk</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" 
                           class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3.5 text-base text-white focus:outline-none focus:border-[#F0B22B] transition-all" 
                           placeholder="Nama laptop/aksesoris">
                </div>
                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-xs font-bold uppercase tracking-wider ml-1">Kategori</label>
                    <div class="relative">
                        <select name="category" class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3.5 text-base text-white focus:outline-none focus:border-[#F0B22B] appearance-none cursor-pointer">
                            <option value="Laptop" @selected($product->category == 'Laptop')>Laptop</option>
                            <option value="Aksesoris" @selected($product->category == 'Aksesoris')>Aksesoris</option>
                        </select>
                        <svg class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-[#F0B22B]" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="m6 9 6 6 6-6"/></svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-xs font-bold uppercase tracking-wider ml-1">Harga (Rupiah)</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" 
                           class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3.5 text-base text-white focus:outline-none focus:border-[#F0B22B]">
                </div>
                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-xs font-bold uppercase tracking-wider ml-1">Stok Tersedia</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" 
                           class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3.5 text-base text-white focus:outline-none focus:border-[#F0B22B]">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[#F0B22B] text-xs font-bold uppercase tracking-wider ml-1">Spesifikasi Singkat</label>
                <textarea name="specs" rows="3" class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3.5 text-base text-white focus:outline-none focus:border-[#F0B22B]">{{ old('specs', $product->specs) }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="text-[#F0B22B] text-xs font-bold uppercase tracking-wider ml-1">Detail Produk</label>
                <textarea name="details" rows="4" class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3.5 text-base text-white focus:outline-none focus:border-[#F0B22B]">{{ old('details', $product->details) }}</textarea>
            </div>

            <div class="p-6 bg-white/5 rounded-3xl border border-dashed border-white/20">
                <div class="flex flex-col sm:flex-row items-center gap-8">
                    @if($product->photo)
                        <div class="relative group shrink-0">
                            <img src="{{ asset('storage/' . $product->photo) }}" class="w-32 h-32 object-cover rounded-2xl border-2 border-[#F0B22B] shadow-lg">
                            <span class="absolute -top-2 -right-2 bg-[#F0B22B] text-[#090069] text-[10px] font-bold px-2 py-0.5 rounded-full">AKTIF</span>
                        </div>
                    @endif
                    <div class="flex-1 text-center sm:text-left">
                        <p class="text-white font-bold mb-3">Upload Foto Baru</p>
                        <input type="file" name="photo" class="text-sm text-gray-400
                            file:mr-4 file:py-2.5 file:px-6
                            file:rounded-xl file:border-0
                            file:text-sm file:font-bold
                            file:bg-[#F0B22B] file:text-[#090069]
                            hover:file:brightness-110 cursor-pointer transition-all">
                    </div>
                </div>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" 
                        class="w-full sm:w-auto px-10 py-3.5 bg-[#F0B22B] text-[#090069] rounded-2xl font-bold text-base uppercase tracking-wider hover:scale-[1.02] active:scale-[0.98] transition-all shadow-xl shadow-[#F0B22B]/10">
                    Update Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection