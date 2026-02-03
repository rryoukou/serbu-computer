<footer class="bg-[#F3F3F3] text-center pt-10">

    <!-- LOGO -->
    <div class="flex justify-center mb-4">
        <img src="{{ asset('images/logo.png') }}"
             alt="Serbu Comp"
             class="h-10">
    </div>

    <!-- FOOTER MENU -->
    <nav class="flex justify-center flex-wrap gap-6 text-sm font-medium text-black mb-6">
        <a href="{{ auth()->check() ? route('dashboard') : route('home') }}"
           class="hover:text-[#F0B22B] transition">Home</a>

        <a href="{{ route('shop.index') }}"
           class="hover:text-[#F0B22B] transition">Products</a>

        <a href="{{ route('pages.about') }}"
           class="hover:text-[#F0B22B] transition">About</a>

        @auth
            <a href="{{ route('riwayat.index') }}"
               class="hover:text-[#F0B22B] transition">History</a>

            <a href="{{ route('profile.edit') }}"
               class="hover:text-[#F0B22B] transition">Profile</a>
        @endauth
    </nav>

    <!-- SOCIAL MEDIA -->
    <div class="flex justify-center gap-4 mb-8">

        <!-- Instagram -->
        <a href="https://instagram.com"
           target="_blank"
           class="w-10 h-10 bg-[#F0B22B] rounded-full flex items-center justify-center
                  hover:scale-105 transition">
            <svg xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="black"
                 stroke-width="2"
                 class="w-4 h-4">
                <rect x="2" y="2" width="20" height="20" rx="5"/>
                <circle cx="12" cy="12" r="4"/>
                <circle cx="17" cy="7" r="1"/>
            </svg>
        </a>

        <!-- WhatsApp -->
        <a href="https://wa.me/628xxxxxxxxxx"
           target="_blank"
           class="w-10 h-10 bg-[#F0B22B] rounded-full flex items-center justify-center
                  hover:scale-105 transition">
            <svg xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="black"
                 stroke-width="2"
                 class="w-4 h-4">
                <path d="M21 11.5a8.5 8.5 0 1 1-3.5-6.9"/>
                <path d="M8.5 10.5c1.5 3 3 4.5 6 6"/>
            </svg>
        </a>

        <!-- Facebook -->
        <a href="https://facebook.com"
           target="_blank"
           class="w-10 h-10 bg-[#F0B22B] rounded-full flex items-center justify-center
                  hover:scale-105 transition">
            <svg xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="black"
                 stroke-width="2"
                 class="w-4 h-4">
                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
            </svg>
        </a>

    </div>

    <!-- COPYRIGHT -->
    <div class="bg-[#F0B22B] py-3 text-xs font-medium text-black">
        © {{ date('Y') }} Serbu Comp. All Rights Reserved.
    </div>

</footer>
