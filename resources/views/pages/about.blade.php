@extends('layouts.user')

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
    {{-- Header --}}
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">About Us</h1>
        <p class="text-gray-600 text-lg">Kenali lebih dekat Serbu Computer dan misi kami.</p>
    </div>

    {{-- Konten --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        {{-- Gambar --}}
        <div class="flex justify-center">
            <img src="https://images.unsplash.com/photo-1581091215368-9b1f6be45b27?auto=format&fit=crop&w=600&q=80" 
                 alt="About Image" 
                 class="rounded-lg shadow-lg object-cover w-full max-w-md">
        </div>

        {{-- Teks --}}
        <div class="space-y-4">
            <p class="text-gray-700 text-lg">
                Serbu Computer adalah perusahaan yang bergerak di bidang teknologi dan penjualan laptop serta aksesori komputer terbaik. 
                Kami berkomitmen untuk memberikan pengalaman belanja yang nyaman dan produk berkualitas tinggi bagi setiap pelanggan.
            </p>
            <p class="text-gray-700 text-lg">
                Misi kami adalah menghadirkan solusi teknologi yang mudah diakses, terpercaya, dan inovatif. 
                Kami selalu mengutamakan kepuasan pelanggan dan terus berkembang mengikuti tren terbaru di dunia komputer.
            </p>
            <p class="text-gray-700 text-lg font-semibold">
                Bergabunglah dengan kami dan temukan produk komputer terbaik sesuai kebutuhanmu!
            </p>
        </div>
    </div>
</div>
@endsection
