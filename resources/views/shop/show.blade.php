@extends('layouts.user')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-10">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

        {{-- FOTO --}}
        <div>
            <img
                src="{{ $product->photo
                    ? asset('storage/' . $product->photo)
                    : 'https://source.unsplash.com/600x400/?laptop,computer' }}"
                alt="{{ $product->name }}"
                class="w-full rounded-xl shadow-lg object-cover">
        </div>

        {{-- DETAIL --}}
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-3">
                {{ $product->name }}
            </h1>

            <p class="text-2xl text-blue-600 font-bold mb-4">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </p>

            {{-- STOK --}}
            <p class="mb-4">
                Stok:
                @if ($product->stock > 0)
                    <span class="text-green-600 font-semibold">
                        {{ $product->stock }} tersedia
                    </span>
                @else
                    <span class="text-red-600 font-semibold">
                        Habis
                    </span>
                @endif
            </p>

            {{-- TOMBOL --}}
           <form action="{{ route('cart.add', $product->id) }}" method="POST">
    @csrf
    <button
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
        🛒 Tambah ke Keranjang
    </button>
</form>
<a href="{{ route('checkout.show', $product->id) }}"
   class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition inline-block">
   💳 Beli Sekarang
</a>





            {{-- SPESIFIKASI --}}
            @if ($product->specs)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Spesifikasi</h3>
                    <div class="bg-gray-100 p-4 rounded-lg text-gray-700 whitespace-pre-line">
                        {{ $product->specs }}
                    </div>
                </div>
            @endif

            {{-- DETAIL BARANG --}}
            @if ($product->details)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Detail Produk</h3>
                    <p class="text-gray-700 leading-relaxed">
                        {{ $product->details }}
                    </p>
                </div>
            @endif

            {{-- PANDUAN --}}
            @if ($product->purchase_guide)
                <div>
                    <h3 class="text-lg font-semibold mb-2">Panduan Pembelian</h3>
                    <p class="text-gray-700 leading-relaxed">
                        {{ $product->purchase_guide }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
