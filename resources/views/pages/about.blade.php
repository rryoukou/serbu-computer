@extends('layouts.main')

@section('content')

<section class="relative bg-[#F3F3F3] overflow-x-hidden reveal">
    <div class="hidden md:block absolute inset-y-0 left-0 w-[220px] bg-[#090069]"
        style="clip-path: polygon(0 0, 3% 0, 70% 100%, 0% 100%);">
    </div>

    <div class="md:hidden absolute top-0 left-0 w-full h-20 bg-[#090069]"
        style="clip-path: polygon(0 0, 100% 0, 100% 25%, 0 100%);">
    </div>

    <div class="relative max-w-7xl mx-auto px-6 sm:px-10 md:px-16 py-8 md:py-16
                grid grid-cols-1 md:grid-cols-2 items-center md:translate-x-7">

        <div class="relative flex justify-center md:justify-end items-center order-1 md:order-2 mt-4 md:mt-0 mb-6 md:mb-0">
            <img src="{{ asset('images/hero.png') }}" alt="Laptop"
                class="relative z-10 w-[260px] sm:w-[320px] md:w-[500px] object-contain md:translate-x-6 drop-shadow-2xl">
        </div>

        <div class="relative z-10 order-2 md:order-1 text-center md:text-left">
            <h1 class="text-3xl sm:text-5xl md:text-7xl font-extrabold text-black leading-tight mb-4 md:mb-6">
                Tentang Serbu Computer
            </h1>
            <p class="text-gray-700 text-sm sm:text-lg md:text-xl mb-8 md:mb-10 max-w-md mx-auto md:mx-0 leading-relaxed">
                Your trusted place for laptops and accessories in <span class="text-[#090069] font-bold border-b-2 border-[#F0B22B]">Serbu Computer</span>.
            </p>
        </div>
    </div>
</section>

<section id="about-section" class="bg-gradient-to-b from-[#090069] to-[#0c0c3d] py-16 px-6 md:px-16 reveal">
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 items-center">
        <div class="rounded-2xl h-72 md:h-80 overflow-hidden shadow-2xl border border-white/10">
            <img src="{{ asset('images/masag.jpeg') }}" class="w-full h-full object-cover"> </div>

        <div class="text-white">
            <h3 class="text-[#F0B22B] text-2xl font-bold mb-4">Pemilik & Pendiri</h3>
            <p class="text-gray-300 leading-relaxed text-justify md:text-left">
                Agong Wibowo adalah pendiri Serbu Computer Sawojajar yang berpengalaman dalam penjualan dan servis laptop. Dengan mengutamakan kejujuran dan kualitas layanan, Serbu Computer hadir sebagai solusi terpercaya untuk kebutuhan laptop dan teknologi pelanggan.
            </p>
        </div>
    </div>
</section>

<section class="bg-gradient-to-b from-[#0c0c3d] to-[#090069] py-16 px-6 md:px-16 reveal">
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 items-center">
        <div class="text-white order-2 md:order-1">
            <h3 class="text-[#F0B22B] text-2xl font-bold mb-4">Profil Toko</h3>
            <p class="text-gray-300 leading-relaxed text-justify md:text-left">
                Serbu Computer merupakan toko laptop dan aksesoris di Sawojajar, Kota Malang yang melayani jual beli, upgrade, dan servis laptop dengan harga bersaing serta pelayanan yang cepat dan transparan.
            </p>
        </div>

        <div class="rounded-2xl h-72 md:h-80 overflow-hidden shadow-2xl border border-white/10 order-1 md:order-2 mb-6 md:mb-0">
            <img src="{{ asset('images/warung.jpeg') }}" class="w-full h-full object-cover">
        </div>
    </div>
</section>

<section class="bg-[#090069] py-16 px-6 md:px-16 reveal">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-12">
            <h3 class="text-[#F0B22B] text-2xl md:text-3xl font-bold mb-2">Mengapa Memilih Kami?</h3>
            <p class="text-gray-400 text-sm md:text-base">Komitmen Serbu Computer untuk memberikan pengalaman terbaik bagi Anda.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @php
                $items = [
                    [
                        'title' => 'Keamanan Terjamin',
                        'desc' => 'Setiap transaksi aman dan data privasi pelanggan kami lindungi sepenuhnya.',
                        'svg' => '<path d="M12 2L3 7v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-9-5zm-1 15l-4-4 1.41-1.41L11 14.17l5.59-5.59L18 10l-7 7z"/>'
                    ],
                    [
                        'title' => 'Harga Terbaik',
                        'desc' => 'Penawaran harga yang jujur, transparan, dan sangat kompetitif di wilayah Sawojajar.',
                        'svg' => '<path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58s1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41s-.23-1.05-.59-1.42zM5.5 8.25c-.97 0-1.75-.78-1.75-1.75s.78-1.75 1.75-1.75 1.75.78 1.75 1.75-.78 1.75-1.75 1.75z"/>'
                    ],
                    [
                        'title' => 'Layanan Responsif',
                        'desc' => 'Tim teknisi kami siap memberikan konsultasi gratis dan perbaikan dengan durasi cepat.',
                        'svg' => '<path d="M7 2v11h3v9l7-12h-4l4-8z"/>'
                    ],
                    [
                        'title' => 'Kualitas Teruji',
                        'desc' => 'Seluruh unit laptop dan aksesori telah melewati tahap Quality Control yang ketat.',
                        'svg' => '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14l-5-4.87 6.91-1.01L12 2z"/>'
                    ],
                ];
            @endphp

            @foreach($items as $item)
            <div class="flex items-center gap-5 bg-[#0c0c3d] rounded-2xl p-6 text-white border border-white/5 hover:border-[#F0B22B]/40 transition-all duration-300 group shadow-lg">
                <div class="flex-shrink-0 w-14 h-14 bg-[#F0B22B] rounded-full flex items-center justify-center shadow-[0_0_15px_rgba(240,178,43,0.2)] group-hover:shadow-[0_0_20px_rgba(240,178,43,0.4)] group-hover:scale-110 transition-all duration-300">
                    <svg class="w-8 h-8 text-[#090069]" fill="currentColor" viewBox="0 0 24 24">
                        {!! $item['svg'] !!}
                    </svg>
                </div>
                
                <div>
                    <h4 class="font-bold text-lg mb-1 group-hover:text-[#F0B22B] transition-colors uppercase tracking-tight">
                        {{ $item['title'] }}
                    </h4>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        {{ $item['desc'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-gradient-to-b from-[#090069] to-[#0c0c3d] py-12 md:py-16 px-6 md:px-16 reveal">
    <div class="max-w-6xl mx-auto">
        <h3 class="text-[#F0B22B] text-2xl font-bold mb-6 text-center md:text-left">Lokasi Toko Kami</h3>

        <div class="rounded-2xl overflow-hidden border border-white/10 bg-[#0c0c3d] shadow-2xl">
            <div id="map" class="w-full h-60 md:h-80"></div>

            <div class="p-5 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-start gap-3 text-gray-200">
                    <svg class="w-5 h-5 text-[#F0B22B] mt-1 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                    <div>
                        <p class="font-bold">Serbu Computer Sawojajar</p>
                        <p class="text-sm text-gray-400">Jl. Danau Djonge H8/H19, Kota Malang</p>
                    </div>
                </div>
                <a href="https://maps.app.goo.gl/6g7RGvZpJBhT2zVS6" target="_blank"
                   class="bg-[#F0B22B] text-[#090069] px-6 py-2.5 rounded-full font-bold text-sm text-center hover:brightness-110 transition">
                    Lihat di Google Maps
                </a>
            </div>
        </div>
    </div>
</section>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const coords = [-7.975041062529727, 112.67047620610623];
    const map = L.map('map', {
        center: coords,
        zoom: 16,
        scrollWheelZoom: false
    });
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    L.marker(coords).addTo(map);

    // Reveal Animation
    const observer = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.style.opacity = '1';
                e.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all .7s ease-out';
        observer.observe(el);
    });
});
</script>

<style>
    .leaflet-control-attribution { display: none !important; }
</style>

@endsection