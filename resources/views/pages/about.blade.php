@extends('layouts.main')

@section('content')

<!-- HERO -->
<section class="relative bg-[#F3F3F3] overflow-x-hidden reveal">
    <div class="hidden md:block absolute inset-y-0 left-0 w-[220px] bg-[#090069]"
        style="clip-path: polygon(0 0, 3% 0, 70% 100%, 0% 100%);"></div>

    <div class="relative max-w-7xl mx-auto px-6 md:px-16 py-14
                grid grid-cols-1 md:grid-cols-2 items-center md:translate-x-7">

        <div>
            <h1 class="text-4xl md:text-6xl font-bold mb-4">
                Tentang Serbu Computer
            </h1>
            <p class="text-gray-600 max-w-md">
                Your trusted place for laptops and accessories in Sawojajar.
            </p>
        </div>

        <div class="flex justify-center md:justify-end">
            <img src="{{ asset('images/hero.png') }}"
                 class="w-[280px] md:w-[420px] object-contain">
        </div>
    </div>
</section>

<!-- OWNER -->
<section class="bg-gradient-to-b from-[#090069] to-[#0c0c3d] py-20 px-6 md:px-16 reveal">
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center">

        <div class="rounded-2xl h-64 overflow-hidden">
            <img src="{{ asset('images/masag.jpeg') }}"
                 class="w-full h-full object-cover">
        </div>

        <div class="text-white">
            <h3 class="text-[#F0B22B] text-2xl font-semibold mb-4">
                Pemilik & Pendiri
            </h3>
            <p class="text-gray-300 leading-relaxed"> Agong Wibowo adalah pendiri Serbu Computer Sawojajar yang berpengalaman dalam penjualan dan servis laptop. Dengan mengutamakan kejujuran dan kualitas layanan, Serbu Computer hadir sebagai solusi terpercaya untuk kebutuhan laptop dan teknologi pelanggan. </p>
        </div>
    </div>
</section>

<!-- TOKO -->
<section class="bg-gradient-to-b from-[#0c0c3d] to-[#090069] py-20 px-6 md:px-16 reveal">
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center">

        <div class="text-white">
            <h3 class="text-[#F0B22B] text-2xl font-semibold mb-4">
                Profil Toko
            </h3>
            <p class="text-gray-300 leading-relaxed"> Serbu Computer merupakan toko laptop dan aksesoris di Sawojajar, Kota Malang yang melayani jual beli, upgrade, dan servis laptop dengan harga bersaing serta pelayanan yang cepat dan transparan. </p>
        </div>

        <div class="rounded-2xl h-64 overflow-hidden">
            <img src="{{ asset('images/warung.jpeg') }}"
                 class="w-full h-full object-cover">
        </div>
    </div>
</section>

<!-- KEUNGGULAN -->
<section class="bg-[#090069] py-20 px-6 md:px-16 reveal">
    <div class="max-w-6xl mx-auto">

        <h3 class="text-center text-[#F0B22B] text-2xl font-semibold mb-12">
            Keunggulan Kami
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @php
                $items = [
                    ['title'=>'Keamanan Terjamin','desc'=>'Transaksi aman dan data terlindungi.','icon'=>'M12 1a5 5 0 00-5 5v4H6a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2v-8a2 2 0 00-2-2h-1V6a5 5 0 00-5-5z'],
                    ['title'=>'Harga Terbaik','desc'=>'Harga transparan dan kompetitif.','icon'=>'M12 2a10 10 0 100 20 10 10 0 000-20z'],
                    ['title'=>'Layanan Responsif','desc'=>'Cepat membantu pelanggan.','icon'=>'M2 3h20v14H6l-4 4V3z'],
                    ['title'=>'Pengiriman Cepat','desc'=>'Diproses tepat waktu.','icon'=>'M3 13h14l4-4v6l-4-4H3z'],
                ];
            @endphp

            @foreach($items as $item)
            <div class="flex gap-4 bg-[#0c0c3d] rounded-xl p-6 text-white transition hover:-translate-y-1">
                <svg class="w-8 h-8 text-[#F0B22B]" fill="currentColor" viewBox="0 0 24 24">
                    <path d="{{ $item['icon'] }}"/>
                </svg>
                <div>
                    <h4 class="font-semibold mb-1">{{ $item['title'] }}</h4>
                    <p class="text-gray-300 text-sm">{{ $item['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- MAP (ONE CARD, NYATU) -->
<section class="bg-gradient-to-b from-[#090069] to-[#0c0c3d] py-20 px-6 md:px-16 reveal">
    <div class="max-w-6xl mx-auto space-y-6">

        <h3 class="text-[#F0B22B] text-2xl font-semibold">
            Lokasi Toko Kami
        </h3>

        <!-- CARD WRAPPER -->
        <div class="rounded-2xl overflow-hidden border border-white/10 bg-[#0c0c3d]">

            <!-- MAP -->
            <div id="map" class="w-full h-72"></div>

            <!-- INFO BAR -->
            <div class="p-5
                        flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div class="flex items-start gap-3 text-gray-200">
                    <svg class="w-5 h-5 text-[#F0B22B] mt-1" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 11.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19 10c0 6-7 12-7 12S5 16 5 10a7 7 0 1114 0z"/>
                    </svg>

                    <div>
                        <p class="font-semibold">Serbu Computer Sawojajar</p>
                        <p class="text-sm text-gray-400">
                            Jl. Danau Djonge H8/H19, Kota Malang
                        </p>
                    </div>
                </div>

                <a href="https://www.google.com/maps?q=-7.975041062529727,112.67047620610623"
                   target="_blank"
                   class="inline-flex items-center justify-center
                          px-6 py-2.5 rounded-full
                          bg-[#F0B22B] text-[#090069]
                          font-semibold text-sm
                          hover:brightness-110 transition">
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
        scrollWheelZoom: true
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    L.marker(coords).addTo(map);

    // REVEAL FIX (AMAN)
    const reveals = document.querySelectorAll('.reveal');
    reveals.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(40px)';
        el.style.transition = 'all .8s ease';
    });

    const observer = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.style.opacity = '1';
                e.target.style.transform = 'translateY(0)';
                observer.unobserve(e.target);
            }
        });
    }, { threshold: 0.15 });

    reveals.forEach(el => observer.observe(el));
});
</script>

@endsection
