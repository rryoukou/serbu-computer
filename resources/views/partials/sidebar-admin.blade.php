<div class="sidebar p-4 bg-gray-800 text-white min-h-screen">
    <h3 class="text-xl font-bold mb-4">ADMIN PANEL</h3>
    <hr class="border-gray-600 mb-4">

    <a href="{{ route('admin.dashboard') }}"
       class="block py-2 px-3 rounded hover:bg-gray-700 mb-2">
        🛠 Dashboard Admin
    </a>

    {{-- Manajemen Produk --}}
    <a href="{{ route('admin.products.index') }}"
       class="block py-2 px-3 rounded hover:bg-gray-700 mb-2">
        📦 Manajemen Produk
    </a>

    {{-- Riwayat Pembelian --}}
    <a href="{{ route('admin.orders.index') }}"
       class="block py-2 px-3 rounded hover:bg-gray-700 mb-2">
        🧾 Riwayat Pembelian
    </a>

    {{-- Manajemen Pengguna --}}
<a href="{{ route('admin.users.index') }}"
   class="block py-2 px-3 rounded hover:bg-gray-700 mb-2">
    👤 Manajemen Pengguna
</a>


    {{-- Logout --}}
    <form method="POST" action="{{ route('logout') }}" class="mt-6">
        @csrf
        <button type="submit"
            class="w-full text-left py-2 px-3 rounded hover:bg-red-600 bg-red-500">
            🚪 Logout
        </button>
    </form>
</div>
