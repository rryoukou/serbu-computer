@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Produk</h1>

@if(session('success'))
    <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ old('name', $product->name) }}" placeholder="Nama Produk" class="border p-2 w-full">
    
    <select name="category" class="border p-2 w-full">
        <option value="Laptop" @selected($product->category == 'Laptop')>Laptop</option>
        <option value="Aksesoris" @selected($product->category == 'Aksesoris')>Aksesoris</option>
    </select>

    <textarea name="specs" placeholder="Spesifikasi" class="border p-2 w-full">{{ old('specs', $product->specs) }}</textarea>
    <input type="number" name="price" value="{{ old('price', $product->price) }}" placeholder="Harga" class="border p-2 w-full">
    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" placeholder="Stok" class="border p-2 w-full">
    <textarea name="details" placeholder="Detail Produk" class="border p-2 w-full">{{ old('details', $product->details) }}</textarea>
    <textarea name="purchase_guide" placeholder="Panduan Pembelian" class="border p-2 w-full">{{ old('purchase_guide', $product->purchase_guide) }}</textarea>

    @if($product->photo)
        <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover mb-2">
    @endif
    <input type="file" name="photo" class="border p-2 w-full">

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Produk</button>
</form>
@endsection
