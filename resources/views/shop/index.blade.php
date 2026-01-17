@extends('layouts.user')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">

    {{-- Header --}}
    <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-3">
            Our Products
        </h1>
        <p class="text-gray-600 text-lg">
            Temukan laptop dan aksesori komputer terbaik dari Serbu Computer
        </p>
    </div>

    {{-- Grid Produk --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

        @forelse ($products as $product)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">

                {{-- Foto Produk --}}
                <img 
                    src="{{ $product->photo 
                        ? asset('storage/' . $product->photo) 
                        : 'https://via.placeholder.com/400x300?text=No+Image' }}"
                    alt="{{ $product->name }}"
                    class="w-full h-48 object-cover">

                {{-- Konten --}}
                <div class="p-4">
                    <h2 class="text-lg font-semibold text-gray-800 mb-1">
                        {{ $product->name }}
                    </h2>

                    <p class="text-blue-600 font-bold mb-4">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
<a href="{{ route('shop.show', $product->id) }}"
   class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition">
    Detail Produk
</a>


                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500 text-lg">
                Belum ada produk tersedia.
            </p>
        @endforelse

    </div>
</div>
@endsection
