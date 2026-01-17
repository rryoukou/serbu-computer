@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>

@if(session('success'))
    <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('admin.products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Produk</a>

<table class="min-w-full bg-white border rounded">
    <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2 border">Foto</th>
            <th class="px-4 py-2 border">Nama</th>
            <th class="px-4 py-2 border">Kategori</th>
            <th class="px-4 py-2 border">Harga</th>
            <th class="px-4 py-2 border">Stok</th>
            <th class="px-4 py-2 border">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr class="text-center">
            <td class="border px-2 py-2">
                @if($product->photo)
                    <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover mx-auto">
                @else
                    -
                @endif
            </td>
            <td class="border px-4 py-2">{{ $product->name }}</td>
            <td class="border px-4 py-2">{{ $product->category }}</td>
            <td class="border px-4 py-2">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
            <td class="border px-4 py-2">{{ $product->stock }}</td>
            <td class="border px-4 py-2 space-x-2">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="bg-yellow-400 text-white px-2 py-1 rounded">Edit</a>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus produk ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $products->links() }} <!-- pagination -->
</div>
@endsection
