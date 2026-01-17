@extends('layouts.admin')

@section('content')
<h1>Tambah Produk</h1>

@if(session('success'))
    <div class="bg-green-200 p-2 rounded">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    <input type="text" name="name" placeholder="Nama Produk" class="border p-2 w-full">
    
    <select name="category" class="border p-2 w-full">
        <option value="">Pilih Kategori</option>
        <option value="Laptop">Laptop</option>
        <option value="Aksesoris">Aksesoris</option>
    </select>

    <textarea name="specs" placeholder="Spesifikasi" class="border p-2 w-full"></textarea>
    <input type="number" name="price" placeholder="Harga" class="border p-2 w-full">
    <input type="number" name="stock" placeholder="Stok" class="border p-2 w-full">
    <textarea name="details" placeholder="Detail Produk" class="border p-2 w-full"></textarea>
    <textarea name="purchase_guide" placeholder="Panduan Pembelian" class="border p-2 w-full"></textarea>
    <input type="file" name="photo" class="border p-2 w-full">

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Produk</button>
</form>
@endsection
