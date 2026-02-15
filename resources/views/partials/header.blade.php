<header class="bg-[#090069] px-6 md:px-16 py-4 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex items-center justify-between">

        <!-- LOGO -->
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" class="h-10" alt="Serbu Comp">
        </a>

        <!-- MENU -->
        <nav class="hidden md:flex gap-10 text-sm font-semibold text-[#F0B22B]">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('shop.index') }}">Product</a>
            <a href="{{ route('pages.about') }}">About Us</a>

            @auth
                <a href="{{ route('riwayat.index') }}">Riwayat</a>
            @endauth
        </nav>

        <!-- RIGHT AREA -->
        <div class="flex items-center gap-4">

            {{-- SEARCH (SEMUA BOLEH) --}}
            <a href="{{ route('shop.search.page') }}" class="text-[#F0B22B]">
                🔍
            </a>

            {{-- ====== GUEST ====== --}}
            @guest
                <a href="{{ route('login') }}"
                   class="bg-[#F0B22B] text-black font-semibold
                          px-6 py-2 rounded-full">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="border border-white text-white
                          px-6 py-2 rounded-full">
                    Register
                </a>
            @endguest

            {{-- ====== USER LOGIN ====== --}}
            @auth
                {{-- CART --}}
                <a href="{{ route('cart.index') }}" class="relative text-[#F0B22B]">
                    🛒
                    <span class="absolute -top-2 -right-2 bg-red-500 text-xs px-2 rounded-full">
                        {{ session('cart_count', 0) }}
                    </span>
                </a>

                {{-- PROFILE --}}
                <div class="relative">
                    <button id="userBtn" class="text-[#F0B22B]">
                        👤
                    </button>

                    <div id="userMenu"
                         class="hidden absolute right-0 mt-2 w-40
                                bg-white rounded-lg shadow-lg text-black">
                        <a href="{{ route('profile.edit') }}"
                           class="block px-4 py-2 hover:bg-gray-100">
                            Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

        </div>
    </div>
</header>

<script>
    const btn = document.getElementById('userBtn');
    const menu = document.getElementById('userMenu');

    if (btn) {
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!btn.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    }
</script>
