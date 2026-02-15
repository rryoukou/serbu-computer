@extends('layouts.main')

@section('content')

<!-- HERO SECTION -->
<section class="relative bg-[#F3F3F3] overflow-x-hidden reveal">

    <!-- LEFT DIAGONAL SHAPE - Hidden on mobile, visible on md+ -->
    <div class="hidden md:block absolute inset-y-0 left-0 w-[140px] md:w-[220px] bg-[#090069]"
        style="clip-path: polygon(0 0, 3% 0, 70% 100%, 0% 100%);">
    </div>

    <!-- Mobile background shape alternative -->
    <div class="md:hidden absolute top-0 left-0 w-full h-32 bg-[#090069]"
        style="clip-path: polygon(0 0, 100% 0, 100% 70%, 0 100%);">
    </div>

    <!-- CONTENT CONTAINER -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 md:px-16 py-8 md:py-12
                grid grid-cols-1 md:grid-cols-2 items-center
                md:translate-x-7">

        <!-- TEXT SECTION -->
        <div class="relative z-10 order-2 md:order-1 mt-8 md:mt-0">
            <h1 class="text-3xl sm:text-4xl md:text-6xl font-bold text-black leading-tight mb-4 md:mb-6">
                <span class="block">Complete Your</span>
                <span class="block">Laptop Setup Today</span>
            </h1>

            <p class="text-gray-700 text-base sm:text-lg md:text-lg mb-6 md:mb-8 max-w-md">
                Laptops and accessories you can book easily at Serbu Comp.
            </p>

            <button onclick="scrollToAbout()"
                class="w-full sm:w-auto bg-[#F0B22B] px-8 sm:px-10 py-3 sm:py-4 
                       rounded-full font-semibold hover:scale-105 transition
                       text-sm sm:text-base">
                Started Now
            </button>
        </div>

        <!-- IMAGE SECTION -->
        <div class="relative flex justify-center md:justify-end items-center order-1 md:order-2">
            <img
                src="{{ asset('images/hero.png') }}"
                alt="Laptop"
                class="relative z-10 w-[280px] sm:w-[350px] md:w-[480px] 
                       object-contain md:translate-x-6"
            >
        </div>

    </div>
</section>

<!-- ABOUT SECTION -->
<section id="about-section" class="bg-gradient-to-b px-6 md:px-16 py-20 reveal">
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
<section class="bg-[#090069] px-6 md:px-16 py-20 reveal">
    <h2 class="text-center text-[#F0B22B] text-2xl font-semibold mb-12 tracking-widest">
        PRODUCTS
    </h2>

    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @foreach ($products as $product)
        <div class="group bg-[#0c0c3d] rounded-2xl overflow-hidden text-white 
                   shadow-[0_8px_24px_rgba(0,0,0,0.3)]
                   transition-all duration-500 
                   hover:-translate-y-2 hover:shadow-[0_16px_40px_rgba(240,178,43,0.15)]
                   hover:border hover:border-[#F0B22B]/20
                   relative before:absolute before:inset-0 
                   before:bg-gradient-to-br before:from-transparent before:via-transparent 
                   before:to-[#F0B22B]/5 before:opacity-0 before:transition-opacity 
                   before:duration-500 hover:before:opacity-100">

            <!-- Category Badge -->
            <div class="absolute top-4 left-4 z-20">
                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                             {{ $product->category == 'Laptop' ? 'bg-blue-500' : 'bg-green-500' }} 
                             text-white">
                    {{ $product->category }}
                </span>
            </div>

            <!-- Stock Badge -->
            @if($product->stock > 0)
            <div class="absolute top-4 right-4 z-20">
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-[#F0B22B] text-black">
                    Stock: {{ $product->stock }}
                </span>
            </div>
            @else
            <div class="absolute top-4 right-4 z-20">
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-500 text-white">
                    Out of Stock
                </span>
            </div>
            @endif

            <!-- IMAGE -->
<div class="h-48 bg-gradient-to-b from-[#003A8F] to-[#002a6a] 
            overflow-hidden relative rounded-t-2xl">
    <img
        src="{{ $product->photo 
            ? asset('storage/' . $product->photo)
            : asset('images/placeholder.png') }}"
        alt="{{ $product->name }}"
        class="w-full h-full object-cover transition-transform duration-500 
               group-hover:scale-105"
    />
</div>

            <!-- CONTENT -->
            <div class="p-5 grid grid-cols-2 gap-4 text-xs min-h-[160px] relative z-10">

                <!-- LEFT -->
                <div class="flex flex-col">
                    <h3 class="font-semibold text-sm mb-2 leading-snug 
                               transition-colors duration-300 
                               group-hover:text-[#F0B22B]">
                        {{ $product->name }}
                    </h3>

                    <!-- "starts from" di atas harga -->
                    <div class="mt-auto">
                        <p class="text-gray-300 text-xs mb-1">starts from :</p>
                        <p class="text-[#F0B22B] font-semibold
                                  transition-transform duration-300 
                                  group-hover:scale-105 group-hover:translate-x-1">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <!-- RIGHT -->
                <div class="flex flex-col text-right">
                    <p class="font-semibold mb-2 transition-colors duration-300 
                              group-hover:text-[#F0B22B]">
                        Spesifikasi
                    </p>

                    @php
                        $specs = preg_split("/\r\n|\n|,/", $product->specs);
                    @endphp

                    <p class="text-gray-300 leading-snug mb-4">
                        {{ $specs[0] ?? '' }}<br>
                        {{ $specs[1] ?? '' }}
                    </p>

                    <a href="{{ route('shop.show', $product->id) }}"
                       class="mt-auto inline-block bg-[#F0B22B] text-black px-4 py-1
                              rounded-full text-xs self-end font-medium
                              transition-all duration-300 
                              hover:bg-white hover:scale-105 hover:shadow-lg
                              hover:shadow-[#F0B22B]/30
                              relative overflow-hidden
                              after:absolute after:inset-0 
                              after:bg-gradient-to-r after:from-white/10 
                              after:to-transparent after:translate-x-[-100%]
                              hover:after:translate-x-100 after:transition-transform 
                              after:duration-500">
                        View Details
                    </a>
                </div>

            </div>

            <!-- Corner Accent -->
            <div class="absolute top-0 right-0 w-12 h-12 
                        bg-gradient-to-bl from-[#F0B22B]/0 via-[#F0B22B]/0 to-[#F0B22B]/10 
                        rounded-bl-2xl transition-all duration-500 
                        group-hover:from-[#F0B22B]/10 group-hover:via-[#F0B22B]/5 
                        group-hover:to-[#F0B22B]/20">
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- GALLERY SECTION -->
<section class="bg-[#0c0c3d] px-6 md:px-16 py-16">
    <h2 class="text-center text-[#F0B22B] text-2xl font-semibold mb-8">
        Gallery
    </h2>

    <!-- SLIDER -->
    <div class="relative max-w-4xl mx-auto overflow-hidden">
        <div id="galleryTrack"
             class="flex transition-transform duration-500 ease-in-out">

            @foreach ($gallery as $image)
                <!-- 1 SLIDE FULL WIDTH -->
                <div class="min-w-full px-3">
                    <div class="bg-white rounded-2xl h-52 md:h-64 overflow-hidden">
                        <img
                            src="{{ asset($image) }}"
                            class="w-full h-full object-cover"
                            alt="Gallery Image"
                        >
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- DOTS -->
    <div class="flex justify-center gap-2 mt-5">
        @foreach ($gallery as $index => $img)
            <button
                class="dot w-2.5 h-2.5 rounded-full transition
                {{ $index === 0 ? 'bg-white' : 'bg-white/40' }}"
                onclick="goToSlide({{ $index }})">
            </button>
        @endforeach
    </div>
</section>

<!-- FAQ SECTION -->
<section class="bg-gradient-to-b from-[#090069] to-[#0c0c3d] px-6 md:px-16 py-20 reveal">
    <h2 class="text-center text-[#F0B22B] text-2xl font-semibold mb-10">
        Frequently Asked Questions
    </h2>

    <div class="max-w-3xl mx-auto space-y-4">
        @foreach ($faqs as $index => $faq)
            <div class="faq-item rounded-xl overflow-hidden
                {{ $index === 0 ? 'bg-white' : 'bg-[#0c0c3d]' }}"
            >
                <!-- QUESTION -->
                <button
                    class="faq-question w-full flex justify-between items-center p-5 text-left font-semibold
                    {{ $index === 0 ? 'text-[#F0B22B]' : 'text-white' }}"
                >
                    {{ $faq['question'] }}
                    <span class="faq-icon transition-transform duration-300
                        {{ $index === 0 ? 'rotate-180' : '' }}">
                        ⌄
                    </span>
                </button>

                <!-- ANSWER -->
                <div class="faq-answer px-5 pb-5 text-sm
                    {{ $index === 0 ? 'block text-gray-700' : 'hidden text-gray-300' }}">
                    {{ $faq['answer'] }}
                </div>
            </div>
        @endforeach
    </div>
</section>

<script>
    let currentSlide = 0;
    const track = document.getElementById('galleryTrack');
    const dots = document.querySelectorAll('.dot');
    const totalSlides = dots.length;

    function goToSlide(index) {
        currentSlide = index;
        track.style.transform = `translateX(-${index * 100}%)`;

        dots.forEach((dot, i) => {
            dot.classList.toggle('bg-white', i === index);
            dot.classList.toggle('bg-white/40', i !== index);
        });
    }

    // OPTIONAL: AUTO SLIDE
    setInterval(() => {
        currentSlide = (currentSlide + 1) % totalSlides;
        goToSlide(currentSlide);
    }, 4000);

    function scrollToAbout() {
    document.getElementById('about-section')
        .scrollIntoView({ behavior: 'smooth' });
}

document.addEventListener('DOMContentLoaded', () => {

    /* ===============================
       SCROLL REVEAL ANIMATION
    =============================== */
    const reveals = document.querySelectorAll('.reveal');

    reveals.forEach(el => {
        el.classList.add(
            'opacity-0',
            'translate-y-10',
            'transition',
            'duration-700',
            'ease-out'
        );
    });

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.remove('opacity-0', 'translate-y-10');
                entry.target.classList.add('opacity-100', 'translate-y-0');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    reveals.forEach(el => observer.observe(el));

    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const button = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        const icon   = item.querySelector('.faq-icon');

        button.addEventListener('click', () => {
            const isOpen = !answer.classList.contains('hidden');

            // tutup semua FAQ
            faqItems.forEach(i => {
                i.querySelector('.faq-answer').classList.add('hidden');
                i.querySelector('.faq-icon').classList.remove('rotate-180');
                i.classList.remove('bg-white');
                i.classList.add('bg-[#0c0c3d]');
                i.querySelector('.faq-question').classList.remove('text-[#F0B22B]');
                i.querySelector('.faq-question').classList.add('text-white');
            });

            // buka FAQ yang diklik
            if (!isOpen) {
                answer.classList.remove('hidden');
                icon.classList.add('rotate-180');
                item.classList.remove('bg-[#0c0c3d]');
                item.classList.add('bg-white');
                button.classList.remove('text-white');
                button.classList.add('text-[#F0B22B]');
            }
        });
    });

});
</script>

@endsection
