@extends('layouts.user')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-6 text-gray-800">
        Transaksi Pembelian
    </h1>

    {{-- TAMPILKAN ERROR VALIDASI --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('checkout.store', $product->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- DATA PEMBELI --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="font-semibold text-lg mb-4">Data Pembeli</h2>

            <div class="mb-4">
                <label class="block mb-1">Nama Lengkap</label>
                <input type="text" name="nama_lengkap"
                    value="{{ old('nama_lengkap', $lastOrder->nama_lengkap ?? $user->nama) }}"
                    class="w-full border rounded px-4 py-2"
                    required>
            </div>

            <div>
                <label class="block mb-1">Nomor HP</label>
                <input type="text" name="no_hp"
                    value="{{ old('no_hp', $lastOrder->no_hp ?? $user->no_hp) }}"
                    class="w-full border rounded px-4 py-2"
                    required>
            </div>
        </div>

        {{-- DETAIL PRODUK --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="font-semibold text-lg mb-4">Detail Produk</h2>

            <div class="flex gap-4">
                <img src="{{ $product->photo ? asset('storage/' . $product->photo) : 'https://via.placeholder.com/150' }}"
                     class="w-32 h-32 object-cover rounded">

                <div>
                    <h3 class="font-semibold text-xl">{{ $product->name }}</h3>
                    <p class="text-gray-600 mb-2">{{ $product->specs }}</p>
                    <p class="text-blue-600 font-bold mb-2">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    {{-- TOTAL --}}
                    <p class="text-gray-800 font-semibold mb-2">
                        Total: <span id="total_harga">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </p>

                    <div class="mt-3">
                        <label>Jumlah (maks 2)</label>
                        <input type="number" name="qty" value="{{ old('qty', 1) }}" min="1" max="2"
                            class="w-20 border rounded px-2 py-1">
                    </div>
                </div>
            </div>
        </div>

        {{-- PESAN + METODE PEMBAYARAN --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="mb-4">
                <label class="block mb-1">Pesan untuk Penjual</label>
                <textarea name="pesan" rows="3"
                    class="w-full border rounded px-4 py-2">{{ old('pesan') }}</textarea>
            </div>

            <div>
                <label class="block mb-1">Metode Pembayaran</label>
                <select name="metode_pembayaran" id="metode_pembayaran"
                    class="w-full border rounded px-4 py-2" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="tunai" {{ old('metode_pembayaran') === 'tunai' ? 'selected' : '' }}>Bayar Tunai</option>
                    <option value="bca" {{ old('metode_pembayaran') === 'bca' ? 'selected' : '' }}>Transfer BCA</option>
                </select>
            </div>

            {{-- Upload bukti BCA --}}
            <div class="mt-4 {{ old('metode_pembayaran') === 'bca' ? '' : 'hidden' }}" id="bukti_bayar_div">
                <label>Upload Bukti Pembayaran BCA</label>
                <input type="file" name="bukti_bayar" class="w-full border rounded px-4 py-2">
            </div>
        </div>

        {{-- SUBMIT --}}
        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg text-lg">
            Buat Pesanan
        </button>
    </form>
</div>

{{-- Script untuk interaksi --}}
<script>
    // Untuk upload bukti BCA
    const select = document.getElementById('metode_pembayaran');
    const buktiDiv = document.getElementById('bukti_bayar_div');

    select.addEventListener('change', () => {
        if(select.value === 'bca') {
            buktiDiv.classList.remove('hidden');
        } else {
            buktiDiv.classList.add('hidden');
        }
    });

    // Untuk total harga otomatis
    const qtyInput = document.querySelector('input[name="qty"]');
    const totalSpan = document.getElementById('total_harga');
    const price = {{ $product->price }};

    qtyInput.addEventListener('input', () => {
        let qty = parseInt(qtyInput.value) || 1;
        if(qty > 2) qty = 2;
        if(qty < 1) qty = 1;
        qtyInput.value = qty;

        const total = qty * price;
        totalSpan.textContent = 'Rp ' + total.toLocaleString('id-ID');
    });
</script>
@endsection
