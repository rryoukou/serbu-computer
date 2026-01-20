@extends('layouts.user')

@section('content')
<!-- HERO SECTION -->
<div class="relative h-[500px] md:h-[600px] w-full overflow-hidden rounded-xl shadow-lg">
    <img src="{{ asset('images/poster-laptop.jpg') }}" alt="Laptop Poster" class="w-full h-full object-cover brightness-90">
    
    <div class="absolute inset-0 flex flex-col justify-center items-start px-6 md:px-20">
        <h1 class="text-4xl md:text-6xl font-bold text-white drop-shadow-lg">
            Complete Your Laptop Setup Today
        </h1>
        <p class="text-lg md:text-2xl text-white drop-shadow-md mt-4 max-w-xl">
            Temukan laptop, aksesoris, dan semua yang kamu butuhkan untuk kerja & gaming!
        </p>
        <a href="{{ route('shop.index') }}" class="mt-6 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold shadow-lg transition duration-300">
            Shop Now
        </a>
    </div>
</div>

<!-- MINI LAPTOP GRID -->
<div class="mt-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach (range(1,8) as $item)
    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 p-4 flex flex-col items-center">
        <img src="{{ asset('images/laptop'.$item.'.jpg') }}" alt="Laptop {{ $item }}" class="w-full h-40 object-cover rounded-lg mb-4">
        <h3 class="font-semibold text-lg">Laptop Model {{ $item }}</h3>
        <p class="text-gray-500 mt-1">Rp {{ number_format(5000000 + $item*1000000,0,",",".") }}</p>
        <a href="{{ route('shop.index') }}" class="mt-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition duration-300">
            View Product
        </a>
    </div>
    @endforeach
</div>
@endsection
