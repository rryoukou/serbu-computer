<!-- resources/views/partials/footer.blade.php -->
<footer class="bg-gray-900 text-gray-300 mt-10">
    <div class="container mx-auto px-6 py-8 grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- About -->
        <div>
            <h3 class="text-white font-bold mb-2 text-lg">Serbu Computer</h3>
            <p class="text-gray-400 text-sm">
                Kami menyediakan berbagai produk komputer dan aksesoris berkualitas tinggi. Belanja aman dan nyaman!
            </p>
        </div>

        <!-- Navigation Links -->
        <div>
            <h4 class="text-white font-semibold mb-2">Menu</h4>
            <ul class="space-y-1">
                <li><a href="{{ route('dashboard') }}" class="hover:text-white transition">Home</a></li>
                <li><a href="{{ route('shop.index') }}" class="hover:text-white transition">Product</a></li>
                <li><a href="{{ route('pages.about') }}" class="hover:text-white transition">About Us</a></li>
                <li><a href="{{ route('shop.search.page') }}" class="hover:text-white transition">Search</a></li>
            </ul>
        </div>

        <!-- Social Media -->
        <div>
            <h4 class="text-white font-semibold mb-2">Follow Us</h4>
            <div class="flex gap-4">
                <a href="#" class="hover:text-white transition">🐦 Twitter</a>
                <a href="#" class="hover:text-white transition">📘 Facebook</a>
                <a href="#" class="hover:text-white transition">📸 Instagram</a>
            </div>
        </div>

    </div>

    <div class="text-center text-gray-500 text-sm py-4 border-t border-gray-800 mt-4">
        &copy; 2026 Serbu Computer. All rights reserved.
    </div>
</footer>
