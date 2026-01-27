@extends('layouts.app')

@section('content')

<!-- HERO SECTION -->
<section class="relative bg-[#F3F3F3] overflow-hidden">

    <!-- LEFT DIAGONAL SHAPE -->
    <div class="absolute inset-y-0 left-0 w-[140px] md:w-[220px] bg-[#090069]"
        style="clip-path: polygon(0 0, 3% 0, 70% 100%, 0% 100%);">
    </div>

    <!-- 🔥 DI SINI DIGESER KE KIRI -->
    <div class="relative max-w-7xl mx-auto px-6 md:px-16 py-12
                grid md:grid-cols-2 items-center
                md:translate-x-7">

        <!-- TEXT -->
        <div class="relative z-10">
            <h1 class="text-4xl md:text-6xl font-bold text-black leading-tight mb-6">
                Complete Your <br>
                Laptop Setup Today
            </h1>

            <p class="text-gray-700 text-base md:text-lg mb-8 max-w-md">
                Laptops and accessories you can book easily at Serbu Comp.
            </p>

            <button class="bg-[#F0B22B] text-black font-semibold px-10 py-4 rounded-full">
                Started Now
            </button>
        </div>

        <!-- IMAGE -->
        <div class="relative flex justify-end items-center">
            <img
                src="{{ asset('images/hero.png') }}"
                alt="Laptop"
                class="relative z-10 w-[390px] md:w-[480px] object-contain translate-x-6"
            >
        </div>

    </div>
</section>

<!-- ABOUT SECTION -->
<section class="bg-gradient-to-b from-[#090069] to-[#0c0c3d] px-6 md:px-16 py-20">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10 items-center">
        <!-- Image - DIPERBESAR -->
        <div class="flex justify-center">
            <img 
                src="{{ asset('images/laptop-about.png') }}" 
                alt="About Serbu Comp"
                class="w-full max-w-md h-auto rounded-xl shadow-lg"
            >
        </div>

        <!-- Text -->
        <div class="text-white">
            <h2 class="text-2xl font-semibold text-[#F0B22B] mb-4">
                A Little About Us
            </h2>
            <p class="text-gray-300 leading-relaxed">
                Serbu Comp adalah mitra terpercaya Anda dalam menyediakan laptop dan aksesoris berkualitas dengan harga terjangkau. 
                Kami berkomitmen untuk membantu pelajar, profesional, dan kreator digital menemukan perangkat yang tepat untuk kebutuhan 
                mereka. Dengan layanan pemesanan yang mudah dan dukungan purna jual yang responsif, kami hadir untuk memastikan pengalaman 
                berbelanja teknologi Anda menjadi lebih sederhana dan menyenangkan.
            </p>
        </div>
    </div>
</section>

<!-- PRODUCTS SECTION -->
<section class="bg-[#090069] px-6 md:px-16 py-20">
    <h2 class="text-center text-[#F0B22B] text-2xl font-semibold mb-10">
        PRODUCTS
    </h2>

    <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-6">
        @for ($i = 0; $i < 4; $i++)
            <div class="bg-[#0c0c3d] rounded-xl p-4 text-white">
                <div class="h-32 bg-white/20 rounded mb-4"></div>
                <h3 class="font-semibold mb-1">Laptop Lenovo</h3>
                <p class="text-sm text-gray-300 mb-3">
                    Spesifikasi singkat laptop
                </p>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-[#F0B22B]">Rp 1.000.000</span>
                    <button class="bg-[#F0B22B] text-black text-xs px-3 py-1 rounded-full">
                        View Details
                    </button>
                </div>
            </div>
        @endfor
    </div>
</section>

<!-- GALLERY SECTION -->
<secion class="bg-[#0c0c3d] px-6 md:px-16 py-16">
    <h2 class="text-center text-[#F0B22B] text-2xl font-semibold mb-8">
        Gallery
    </h2>

    <div class="flex justify-center">
        <div class="w-full max-w-4xl h-48 bg-white/10 rounded-xl"></div>
    </div>

    <!-- Dots -->
    <div class="flex justify-center gap-2 mt-4">
        <span class="w-2 h-2 bg-white rounded-full"></span>
        <span class="w-2 h-2 bg-white/40 rounded-full"></span>
        <span class="w-2 h-2 bg-white/40 rounded-full"></span>
    </div>
</secion>

<!-- FAQ SECTION -->
<section class="bg-gradient-to-b from-[#090069] to-[#0c0c3d] px-6 md:px-16 py-20">
    <h2 class="text-center text-[#F0B22B] text-2xl font-semibold mb-10">
        Frequently Asked Questions
    </h2>

    <div class="max-w-3xl mx-auto space-y-4">
        <!-- FAQ Item -->
        <div class="bg-white rounded-xl p-5">
            <h3 class="font-semibold text-[#F0B22B] mb-2">
                Apakah tersedia layanan servis dan konsultasi?
            </h3>
            <p class="text-sm text-gray-700">
                Ya, kami menyediakan layanan servis dan konsultasi berbayar dengan biaya terjangkau.
            </p>
        </div>

        <div class="bg-[#0c0c3d] text-white rounded-xl p-5">
            <h3 class="font-semibold">
                Apakah laptop yang dijual original dan berkualitas?
            </h3>
        </div>

        <div class="bg-[#0c0c3d] text-white rounded-xl p-5">
            <h3 class="font-semibold">
                Di mana lokasi toko Anda?
            </h3>
        </div>

        <div class="bg-[#0c0c3d] text-white rounded-xl p-5">
            <h3 class="font-semibold">
                Apakah bisa COD atau ambil langsung di toko?
            </h3>
        </div>
    </div>
</section>

@endsection
