@extends('layouts.user')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">

    {{-- Header --}}
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-bold text-gray-800">Hasil Pencarian</h2>
        <p class="text-gray-600">
            Kata kunci:
            <span class="font-semibold">
                "{{ $keyword ?? 'Semua Produk' }}"
            </span>
        </p>
    </div>

    {{-- Form Search --}}
    <form method="GET" action="{{ route('shop.search.results') }}" class="mb-10 flex justify-center">
        <input type="text" name="q"
               value="{{ $keyword ?? '' }}"
               class="w-80 px-4 py-2 border rounded-l-lg focus:outline-none"
               placeholder="Cari produk...">
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 rounded-r-lg">
            🔍 Cari
        </button>
    </form>

    {{-- Grid Produk --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

        @forelse ($products as $product)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition">

                <img
                    src="{{ $product->photo
                        ? asset('storage/' . $product->photo)
                        : 'https://source.unsplash.com/400x300/?laptop,computer' }}"
                    class="w-full h-48 object-cover"
                    alt="{{ $product->name }}">

                <div class="p-4">
                    <h3 class="font-semibold text-lg text-gray-800">
                        {{ $product->name }}
                    </h3>

                    <p class="text-blue-600 font-bold mb-3">
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
                Produk tidak ditemukan 😢
            </p>
        @endforelse

    </div>
</div>
@endsection
