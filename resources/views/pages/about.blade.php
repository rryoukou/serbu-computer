@extends('layouts.main')

@section('content')

<section class="relative bg-[#F3F3F3] overflow-hidden py-8 md:py-12 reveal-item opacity-0 transform translate-y-8 transition-all duration-700">
    <div class="hidden md:block absolute top-0 right-0 w-[120px] h-full bg-[#090069] z-0"
    style="clip-path: polygon(100% 0, 100% 100%, 0% 100%, 80% 0);">
    </div>

    <div class="md:hidden absolute top-0 left-0 w-full h-6 bg-[#090069]"
        style="clip-path: polygon(0 0, 100% 0, 100% 20%, 0 100%);">
    </div>

    <div class="relative max-w-7xl mx-auto px-6 md:px-16 z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-8">
            <div class="order-1 flex justify-center md:justify-start">
                <div class="relative">
                    <img src="{{ asset('images/hero.png') }}" alt="Laptop Serbu Computer"
                        class="relative z-10 w-[260px] sm:w-[340px] md:w-[480px] object-contain drop-shadow-xl">
                </div>
            </div>

            <div class="order-2 text-center md:text-left">
                <h1 class="text-3xl sm:text-5xl md:text-6xl font-black text-black leading-tight mb-4">
                    About Serbu Computer
                </h1>
                <p class="text-gray-700 text-base md:text-lg max-w-lg leading-relaxed font-medium mx-auto md:mx-0">
                    Your trusted place for laptops and accessories in 
                    <span class="inline-block text-[#090069] font-bold border-b-4 border-[#F0B22B] pb-1">Serbu Computer</span>.
                </p>
            </div>
        </div>
    </div>
</section>

<section id="about-section" class="bg-gradient-to-b from-[#090069] to-[#0c0c3d] py-16 px-6 md:px-16 reveal-item opacity-0 transform translate-y-8 transition-all duration-700">
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 items-center">
        <div class="rounded-2xl h-72 md:h-80 overflow-hidden shadow-2xl border border-white/10 transition-transform duration-500 hover:scale-[1.02]">
            <img src="{{ asset('images/masag.jpeg') }}" class="w-full h-full object-cover"> 
        </div>

        <div class="text-white">
            <h3 class="text-[#F0B22B] text-2xl font-bold mb-4">Pemilik & Pendiri</h3>
            <p class="text-gray-300 leading-relaxed text-justify md:text-left">
                Agong Wibowo adalah pendiri Serbu Computer Sawojajar yang berpengalaman dalam penjualan dan servis laptop. Dengan mengutamakan kejujuran dan kualitas layanan, Serbu Computer hadir sebagai solusi terpercaya untuk kebutuhan laptop dan teknologi pelanggan.
            </p>
        </div>
    </div>
</section>

<section class="bg-gradient-to-b from-[#0c0c3d] to-[#090069] py-16 px-6 md:px-16 reveal-item opacity-0 transform translate-y-8 transition-all duration-700">
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 items-center">
        <div class="text-white order-2 md:order-1">
            <h3 class="text-[#F0B22B] text-2xl font-bold mb-4">Profil Toko</h3>
            <p class="text-gray-300 leading-relaxed text-justify md:text-left">
                Serbu Computer merupakan toko laptop dan aksesoris di Sawojajar, Kota Malang yang melayani jual beli, upgrade, dan servis laptop dengan harga bersaing serta pelayanan yang cepat dan transparan.
            </p>
        </div>

        <div class="rounded-2xl h-72 md:h-80 overflow-hidden shadow-2xl border border-white/10 order-1 md:order-2 mb-6 md:mb-0 transition-transform duration-500 hover:scale-[1.02]">
            <img src="{{ asset('images/warung.jpeg') }}" class="w-full h-full object-cover">
        </div>
    </div>
</section>

<section class="bg-[#090069] py-16 px-6 md:px-16">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-12 reveal-item opacity-0 transform translate-y-8 transition-all duration-700">
            <h3 class="text-[#F0B22B] text-2xl md:text-3xl font-bold mb-2">Mengapa Memilih Kami?</h3>
            <p class="text-gray-400 text-sm md:text-base">Komitmen Serbu Computer untuk memberikan pengalaman terbaik bagi Anda.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @php
                $items = [
                    ['title' => 'Keamanan Terjamin', 'desc' => 'Setiap transaksi aman dan data privasi pelanggan kami lindungi sepenuhnya.', 'svg' => '<path d="M12 2L3 7v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-9-5zm-1 15l-4-4 1.41-1.41L11 14.17l5.59-5.59L18 10l-7 7z"/>'],
                    ['title' => 'Harga Terbaik', 'desc' => 'Penawaran harga yang jujur, transparan, dan sangat kompetitif di wilayah Sawojajar.', 'svg' => '<path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58s1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41s-.23-1.05-.59-1.42zM5.5 8.25c-.97 0-1.75-.78-1.75-1.75s.78-1.75 1.75-1.75 1.75.78 1.75 1.75-.78 1.75-1.75 1.75z"/>'],
                    ['title' => 'Layanan Responsif', 'desc' => 'Tim teknisi kami siap memberikan konsultasi gratis dan perbaikan dengan durasi cepat.', 'svg' => '<path d="M7 2v11h3v9l7-12h-4l4-8z"/>'],
                    ['title' => 'Kualitas Teruji', 'desc' => 'Seluruh unit laptop dan aksesori telah melewati tahap Quality Control yang ketat.', 'svg' => '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14l-5-4.87 6.91-1.01L12 2z"/>'],
                ];
            @endphp

            @foreach($items as $item)
            <div class="reveal-item opacity-0 transform translate-y-8 transition-all duration-700 flex items-center gap-5 bg-[#0c0c3d] rounded-2xl p-6 text-white border border-white/5 hover:border-[#F0B22B]/40 transition-all duration-300 group shadow-lg">
                <div class="flex-shrink-0 w-14 h-14 bg-[#F0B22B] rounded-full flex items-center justify-center shadow-[0_0_15px_rgba(240,178,43,0.2)] group-hover:shadow-[0_0_20px_rgba(240,178,43,0.4)] group-hover:scale-110 transition-all duration-300">
                    <svg class="w-8 h-8 text-[#090069]" fill="currentColor" viewBox="0 0 24 24">
                        {!! $item['svg'] !!}
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-lg mb-1 group-hover:text-[#F0B22B] transition-colors uppercase tracking-tight">
                        {{ $item['title'] }}
                    </h4>
                    <p class="text-gray-400 text-sm leading-relaxed italic">
                        {{ $item['desc'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-gradient-to-b from-[#090069] to-[#0c0c3d] py-12 md:py-16 px-6 md:px-16 reveal-item opacity-0 transform translate-y-8 transition-all duration-700">
    <div class="max-w-6xl mx-auto">
        <h3 class="text-[#F0B22B] text-3xl font-bold mb-6 text-center">Lokasi Toko Kami</h3>

        <div class="rounded-2xl overflow-hidden border border-white/10 bg-[#0c0c3d] shadow-2xl">
            <div id="map" class="w-full h-60 md:h-80"></div>
            <div class="p-5 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-start gap-3 text-gray-200">
                    <div class="mt-1 shrink-0">
                        <svg class="w-7 h-7 text-[#F0B22B]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Serbu Computer Sawojajar</p>
                        <p class="text-sm text-gray-400">Jl. Danau Djonge H8/H19, Kota Malang</p>
                    </div>
                </div>
                <a href="https://maps.app.goo.gl/bjeKXvUjmE6XMz8C7" target="_blank"
                   class="bg-[#F0B22B] text-[#090069] px-6 py-2.5 rounded-full font-bold text-sm text-center hover:bg-white transition-all duration-300">
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
    // Map Logic
    const coords = [-7.975041062529727, 112.67047620610623];
    const map = L.map('map', {
        center: coords,
        zoom: 16,
        scrollWheelZoom: false
    });
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    L.marker(coords).addTo(map);

    // --- REVEAL ANIMATION LOGIC ---
    const revealItems = document.querySelectorAll('.reveal-item');
    
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Mencari index elemen di antara semua reveal-item untuk staggered effect
                const allItems = Array.from(revealItems);
                const index = allItems.indexOf(entry.target);
                
                setTimeout(() => {
                    entry.target.classList.remove('opacity-0', 'translate-y-8');
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                }, 100); // Delay dasar, bisa disesuaikan

                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    revealItems.forEach(el => observer.observe(el));
});
</script>

<style>
    .leaflet-control-attribution { display: none !important; }
</style>

@endsection