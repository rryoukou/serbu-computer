<!-- resources/views/partials/navbar-user.blade.php -->
<nav class="bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-md">
    <div class="container mx-auto px-6 py-4 flex flex-wrap justify-between items-center">

        <!-- LOGO + MENU -->
        <div class="flex items-center gap-6 flex-wrap">
            <strong class="text-xl font-bold tracking-wide">Serbu Computer</strong>

            {{-- HOME --}}
            <a href="{{ route('home') }}" class="relative group px-2 py-1 hover:text-gray-100 transition-colors">
                Home
                <span class="absolute left-0 -bottom-1 w-full h-0.5 bg-white scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
            </a>

            {{-- PRODUCT --}}
            <a href="{{ route('shop.index') }}" class="relative group px-2 py-1 hover:text-gray-100 transition-colors">
                Product
                <span class="absolute left-0 -bottom-1 w-full h-0.5 bg-white scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
            </a>

            {{-- RIWAYAT (HANYA LOGIN) --}}
            @auth
            <a href="{{ route('riwayat.index') }}" class="relative group px-2 py-1 hover:text-gray-100 transition-colors">
                Riwayat
                <span class="absolute left-0 -bottom-1 w-full h-0.5 bg-white scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
            </a>
            @endauth

            {{-- ABOUT --}}
            <a href="{{ route('pages.about') }}" class="relative group px-2 py-1 hover:text-gray-100 transition-colors">
                About Us
                <span class="absolute left-0 -bottom-1 w-full h-0.5 bg-white scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
            </a>

            {{-- SEARCH --}}
            <a href="{{ route('shop.search.page') }}" class="relative group px-2 py-1 hover:text-gray-100 transition-colors">
                🔍 Search
                <span class="absolute left-0 -bottom-1 w-full h-0.5 bg-white scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
            </a>
        </div>

        <!-- RIGHT SIDE -->
        <div class="flex items-center gap-4 relative">

            {{-- CART (HANYA LOGIN) --}}
            @auth
            <a href="{{ route('cart.index') }}" class="relative hover:text-gray-200 transition-colors">
                🛒
                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full shadow-md">
                    {{ session('cart_count', 0) }}
                </span>
            </a>
            @endauth

            {{-- GUEST BUTTON --}}
            @guest
            <div class="flex gap-3">
                <a href="{{ route('login') }}"
                   class="bg-white text-blue-600 px-4 py-2 rounded hover:bg-gray-100 transition">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="border border-white px-4 py-2 rounded hover:bg-white hover:text-blue-600 transition">
                    Register
                </a>
            </div>
            @endguest

            {{-- AVATAR DROPDOWN (LOGIN SAJA) --}}
            @auth
            <div class="relative">
                <img src="{{ auth()->user()->foto
                        ? asset('storage/foto/' . auth()->user()->foto)
                        : 'https://via.placeholder.com/40' }}"
                     alt="Avatar"
                     class="w-10 h-10 rounded-full cursor-pointer border-2 border-white shadow-md"
                     id="user-avatar">

                <div id="dropdown-menu"
                     class="hidden absolute right-0 mt-2 w-44 bg-white text-black rounded-lg shadow-lg overflow-hidden z-50">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100 transition">
                        Edit Profil
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100 transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
            @endauth

        </div>
    </div>
</nav>

{{-- SCRIPT DROPDOWN --}}
@auth
<script>
    const avatar = document.getElementById('user-avatar');
    const menu = document.getElementById('dropdown-menu');

    if (avatar) {
        avatar.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!avatar.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    }
</script>
@endauth
