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
         alt="Owner Serbu Computer"
         class="w-full h-full object-cover">
</div>

        <div class="text-white">
            <h3 class="text-[#F0B22B] text-2xl font-semibold mb-4">
                Pemilik & Pendiri
            </h3>
            <p class="text-gray-300 leading-relaxed">
    Agong Wibowo adalah pendiri Serbu Computer Sawojajar yang berpengalaman
    dalam penjualan dan servis laptop. Dengan mengutamakan kejujuran dan
    kualitas layanan, Serbu Computer hadir sebagai solusi terpercaya
    untuk kebutuhan laptop dan teknologi pelanggan.
</p>
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
            <p class="text-gray-300 leading-relaxed">
    Serbu Computer merupakan toko laptop dan aksesoris di Sawojajar, Kota Malang
    yang melayani jual beli, upgrade, dan servis laptop dengan harga bersaing
    serta pelayanan yang cepat dan transparan.
</p>
        </div>

        <div class="rounded-2xl h-64 overflow-hidden">
    <img src="{{ asset('images/warung.jpeg') }}"
         alt="Toko Serbu Computer"
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
            <div class="flex gap-4 bg-[#0c0c3d] rounded-xl p-6 text-white
                        transition-all duration-300
                        hover:-translate-y-1 hover:shadow-[0_10px_30px_rgba(240,178,43,0.15)]">

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

<!-- MAP -->
<section class="bg-gradient-to-b from-[#090069] to-[#0c0c3d] py-20 px-6 md:px-16 reveal">
    <div class="max-w-6xl mx-auto">

        <h3 class="text-[#F0B22B] text-2xl font-semibold mb-4">
            Lokasi Toko Kami
        </h3>

        <div class="relative group">
            <div id="map"
                class="w-full h-72 rounded-2xl overflow-hidden cursor-pointer
                       ring-1 ring-white/10
                       group-hover:ring-[#F0B22B]/40 transition"></div>

            <!-- Hint UX -->
            <div class="absolute bottom-3 right-3 bg-black/60 text-white text-xs px-3 py-1 rounded-full">
                Double click untuk buka Google Maps
            </div>
        </div>

        <p class="text-gray-300 text-sm mt-4">
            Jl. Danau Djonge H8/H19, Sawojajar, Kota Malang
        </p>
    </div>
</section>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const coords = [-7.975041062529727, 112.67047620610623];
    const googleMapsUrl = `https://www.google.com/maps?q=${coords[0]},${coords[1]}`;

    const map = L.map('map', {
        center: coords,
        zoom: 16,
        scrollWheelZoom: false,
        doubleClickZoom: false
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    const marker = L.marker(coords).addTo(map)
        .bindPopup('<b>Serbu Computer</b><br>Sawojajar<br><small>Klik untuk buka Maps</small>');

    // double click → Google Maps
    map.on('dblclick', () => {
        window.open(googleMapsUrl, '_blank');
    });

    // klik marker → Google Maps
    marker.on('click', () => {
        window.open(googleMapsUrl, '_blank');
    });

    // reveal animation
    document.querySelectorAll('.reveal').forEach(el => {
        el.classList.add('opacity-0','translate-y-10','transition','duration-700');
    });

    const observer = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.remove('opacity-0','translate-y-10');
                observer.unobserve(e.target);
            }
        });
    }, { threshold: 0.15 });

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
});
</script>

@endsection