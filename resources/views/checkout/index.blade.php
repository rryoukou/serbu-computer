@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-[#090069] py-6">
    <div class="max-w-5xl mx-auto px-4">
        
        {{-- Header --}}
        <div class="mb-6 reveal">
            <h1 class="text-2xl font-bold text-white mb-1">Transaksi Pembelian</h1>
            <p class="text-gray-300 text-sm">Lengkapi data untuk menyelesaikan pembelian</p>
        </div>

        {{-- TAMPILKAN ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-900/30 border border-red-700 rounded-lg text-red-300 reveal">
                <p class="font-semibold mb-2 text-sm">⚠️ Periksa kembali data berikut:</p>
                <ul class="list-disc pl-4 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-xs">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('checkout.store', $product->id) }}" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                {{-- KOLOM KIRI: DATA PEMBELI --}}
                <div class="lg:col-span-2 space-y-5">
                    {{-- DATA PEMBELI --}}
                    <div class="bg-[#0c0c3d] rounded-xl p-4 md:p-5 border border-gray-800 reveal">
                        <h2 class="text-lg font-bold text-white mb-3 pb-2 border-b border-gray-800">Data Pembeli</h2>
                        
                        <div class="space-y-3">
                            <div>
                                <label class="block text-gray-300 text-xs mb-2">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap"
                                    value="{{ old('nama_lengkap', $lastOrder->nama_lengkap ?? auth()->user()->nama) }}"
                                    class="w-full bg-[#090069] border border-gray-700 rounded-lg px-3 py-2.5 text-white text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#F0B22B] focus:border-transparent"
                                    placeholder="Masukkan nama lengkap"
                                    required>
                            </div>

                            <div>
                                <label class="block text-gray-300 text-xs mb-2">Nomor HP/WhatsApp</label>
                                <input type="text" name="no_hp"
                                    value="{{ old('no_hp', $lastOrder->no_hp ?? auth()->user()->no_hp) }}"
                                    class="w-full bg-[#090069] border border-gray-700 rounded-lg px-3 py-2.5 text-white text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#F0B22B] focus:border-transparent"
                                    placeholder="Contoh: 081234567890"
                                    required>
                            </div>
                        </div>
                    </div>

                    {{-- METODE PEMBAYARAN --}}
                    <div class="bg-[#0c0c3d] rounded-xl p-4 md:p-5 border border-gray-800 reveal">
                        <h2 class="text-lg font-bold text-white mb-3 pb-2 border-b border-gray-800">Metode Pembayaran</h2>
                        
                        <div class="space-y-3">
                            <div>
                                <label class="block text-gray-300 text-xs mb-2">Pilih Metode Pembayaran</label>
                                <select name="metode_pembayaran" id="metode_pembayaran"
                                    class="w-full bg-[#090069] border border-gray-700 rounded-lg px-3 py-2.5 text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#F0B22B] focus:border-transparent appearance-none"
                                    required>
                                    <option value="">-- Pilih Metode Pembayaran --</option>
                                    <option value="tunai" {{ old('metode_pembayaran') === 'tunai' ? 'selected' : '' }}>Bayar Tunai</option>
                                    <option value="bca" {{ old('metode_pembayaran') === 'bca' ? 'selected' : '' }}>Transfer BCA</option>
                                </select>
                            </div>

                            {{-- Upload bukti transfer BCA --}}
                            <div id="bukti_bayar_div" class="{{ old('metode_pembayaran') === 'bca' ? '' : 'hidden' }}">
                                <label class="block text-gray-300 text-xs mb-2">Upload Bukti Pembayaran BCA</label>
                                <input type="file" name="bukti_bayar" 
                                    class="w-full file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-[#F0B22B] file:text-black hover:file:bg-yellow-500 bg-[#090069] border border-gray-700 rounded-lg px-3 py-2 text-white text-sm">
                                <p class="text-gray-400 text-xs mt-1">Format: JPG, PNG (Maks. 5MB)</p>
                            </div>

                            {{-- Informasi Pembayaran --}}
                            <div id="info_tunai_div" class="{{ old('metode_pembayaran') === 'tunai' ? '' : 'hidden' }} bg-blue-900/20 border border-blue-800 rounded-lg p-3">
                                <p class="text-blue-300 text-xs font-medium mb-1">Info Pembayaran Tunai:</p>
                                <p class="text-blue-200 text-xs">Bayar langsung di kasir saat barang diambil. Pastikan datang dalam batas waktu yang ditentukan.</p>
                            </div>

                            <div id="info_bca_div" class="{{ old('metode_pembayaran') === 'bca' ? '' : 'hidden' }} bg-blue-900/20 border border-blue-800 rounded-lg p-3">
                                <p class="text-blue-300 text-xs font-medium mb-1">Info Rekening BCA:</p>
                                <p class="text-blue-200 text-xs mb-1">No. Rekening: 1234-5678-9012</p>
                                <p class="text-blue-200 text-xs">A/N: Toko Komputer XYZ</p>
                            </div>
                        </div>
                    </div>

                    {{-- PESAN --}}
                    <div class="bg-[#0c0c3d] rounded-xl p-4 md:p-5 border border-gray-800 reveal">
                        <h2 class="text-lg font-bold text-white mb-3 pb-2 border-b border-gray-800">Pesan Tambahan</h2>
                        
                        <div>
                            <label class="block text-gray-300 text-xs mb-2">Pesan untuk Penjual (Opsional)</label>
                            <textarea name="pesan" rows="2"
                                class="w-full bg-[#090069] border border-gray-700 rounded-lg px-3 py-2.5 text-white text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#F0B22B] focus:border-transparent"
                                placeholder="Contoh: Tolong dikirim secepatnya, warna hitam">{{ old('pesan') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: DETAIL PRODUK & RINGKASAN --}}
                <div class="space-y-5">
                    {{-- DETAIL PRODUK --}}
                    <div class="bg-[#0c0c3d] rounded-xl p-4 border border-gray-800 reveal">
                        <h2 class="text-base font-bold text-white mb-3 pb-2 border-b border-gray-800">Produk yang Dibeli</h2>
                        
                        <div class="space-y-3">
                            {{-- Gambar Produk --}}
                            <div class="relative w-full h-48 bg-[#003A8F] rounded-lg border border-gray-700 overflow-hidden flex items-center justify-center">
            <img src="{{ $product->photo ? asset('storage/' . $product->photo) : 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?auto=format&fit=crop&w=400' }}"
                 alt="{{ $product->name }}"
                 class="w-full h-full object-cover"> </div>
                            
                            {{-- Info Produk --}}
                            <div>
                                <h3 class="font-semibold text-white text-sm mb-1">{{ $product->name }}</h3>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="px-2 py-0.5 bg-[#F0B22B] text-black text-xs font-semibold rounded-full">
                                        {{ $product->category ?? 'Produk' }}
                                    </span>
                                    @if($product->stock > 0)
                                        <span class="px-2 py-0.5 bg-green-500 text-white text-xs font-semibold rounded-full">
                                            Stok: {{ $product->stock }}
                                        </span>
                                    @else
                                        <span class="px-2 py-0.5 bg-red-500 text-white text-xs font-semibold rounded-full">
                                            Habis
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Panduan Pembelian --}}
                            @if($product->purchase_guide)
                            <div class="pt-2 border-t border-gray-800">
                                <p class="text-gray-300 text-xs mb-1">Panduan Pembelian:</p>
                                <p class="text-white text-xs line-clamp-3">
                                    {{ Str::limit($product->purchase_guide, 100) }}
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- RINGKASAN PEMBAYARAN --}}
                    <div class="bg-[#0c0c3d] rounded-xl p-4 border border-gray-800 reveal">
                        <h2 class="text-base font-bold text-white mb-3 pb-2 border-b border-gray-800">Ringkasan Pembayaran</h2>
                        
                        <div class="space-y-3">
                            {{-- Input Jumlah --}}
                            <div>
                                <label class="block text-gray-300 text-xs mb-2">Jumlah Pesanan</label>
                                <div class="flex items-center space-x-3">
                                    <div class="flex items-center border-2 border-[#F0B22B] rounded-lg overflow-hidden bg-black/30">
                                        <button 
                                            type="button" 
                                            onclick="decreaseQuantity()"
                                            class="px-2.5 py-1.5 text-white hover:bg-[#F0B22B]/20 transition text-sm">
                                            −
                                        </button>
                                        <input 
                                            type="number" 
                                            id="quantity" 
                                            name="qty" 
                                            value="{{ old('qty', request('quantity', 1)) }}" 
                                            min="1" 
                                            max="{{ min($product->stock, 2) }}"
                                            class="w-12 text-center border-0 focus:ring-0 bg-transparent text-white font-semibold text-sm">
                                        <button 
                                            type="button" 
                                            onclick="increaseQuantity()"
                                            class="px-2.5 py-1.5 text-white hover:bg-[#F0B22B]/20 transition text-sm">
                                            +
                                        </button>
                                    </div>
                                    <div class="text-gray-400 text-xs">
                                        Maks: {{ min($product->stock, 2) }} unit
                                    </div>
                                </div>
                            </div>

                            {{-- Detail Harga --}}
                            <div class="pt-2 border-t border-gray-800 space-y-1.5">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-300 text-xs">Harga Satuan</span>
                                    <span class="text-white text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-300 text-xs">Jumlah</span>
                                    <span id="quantity-display" class="text-white text-sm">1 unit</span>
                                </div>
                                
                                <div class="flex justify-between items-center pt-2 border-t border-gray-800">
                                    <span class="text-gray-300 text-sm font-semibold">Total Pembayaran</span>
                                    <span id="total_harga" class="text-[#F0B22B] font-bold text-base">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            {{-- Informasi Stok --}}
                            @if($product->stock <= 5)
                            <div class="bg-orange-900/30 border border-orange-700 rounded-lg p-2 mt-2">
                                <p class="text-orange-300 text-xs flex items-center">
                                    <span class="mr-1.5">⚠️</span>
                                    Stok terbatas! Hanya tersedia {{ $product->stock }} unit
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- TOMBOL SUBMIT --}}
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-[#F0B22B] to-[#e0a020] hover:from-[#ffc233] hover:to-[#f0b22b] text-black font-semibold py-2.5 px-4 rounded-lg transition-all duration-300 shadow hover:shadow-lg text-sm reveal">
                        Buat Pesanan
                    </button>
                    
                    {{-- Kembali ke Detail --}}
                       <a href="{{ route('shop.show', $product->id) }}"
   id="backButton"
   class="fixed bottom-4 left-4 z-50
          inline-flex items-center gap-2
          px-4 py-2 rounded-full
          bg-[#0c0c3d] border border-gray-700
          text-sm font-medium text-gray-200
          shadow-lg
          opacity-0 translate-y-4 pointer-events-none
          hover:border-[#F0B22B] hover:text-[#F0B22B]
          transition-all duration-300">
    ← Kembali
</a>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Script untuk interaksi --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('backButton');
    if (!btn) return;

    window.addEventListener('scroll', () => {
        const trigger = 200; // muncul setelah scroll 200px

        if (window.scrollY > trigger) {
            btn.classList.remove('opacity-0', 'translate-y-4', 'pointer-events-none');
            btn.classList.add('opacity-100', 'translate-y-0');
        } else {
            btn.classList.add('opacity-0', 'translate-y-4', 'pointer-events-none');
            btn.classList.remove('opacity-100', 'translate-y-0');
        }
    });
});

    // Untuk upload bukti transfer BCA
    const select = document.getElementById('metode_pembayaran');
    const buktiDiv = document.getElementById('bukti_bayar_div');
    const infoTunaiDiv = document.getElementById('info_tunai_div');
    const infoBcaDiv = document.getElementById('info_bca_div');

    select.addEventListener('change', () => {
        if(select.value === 'bca') {
            buktiDiv.classList.remove('hidden');
            infoTunaiDiv.classList.add('hidden');
            infoBcaDiv.classList.remove('hidden');
        } else if(select.value === 'tunai') {
            buktiDiv.classList.add('hidden');
            infoTunaiDiv.classList.remove('hidden');
            infoBcaDiv.classList.add('hidden');
        } else {
            buktiDiv.classList.add('hidden');
            infoTunaiDiv.classList.add('hidden');
            infoBcaDiv.classList.add('hidden');
        }
    });

    // Quantity Control
    function increaseQuantity() {
        const input = document.getElementById('quantity');
        const max = parseInt(input.max);
        if (parseInt(input.value) < max) {
            input.value = parseInt(input.value) + 1;
            updateTotalPrice();
        }
    }

    function decreaseQuantity() {
        const input = document.getElementById('quantity');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
            updateTotalPrice();
        }
    }

    // Update Total Price
    function updateTotalPrice() {
        const quantity = parseInt(document.getElementById('quantity').value) || 1;
        const price = {{ $product->price }};
        const total = quantity * price;
        
        // Update display
        document.getElementById('total_harga').textContent = 'Rp ' + total.toLocaleString('id-ID');
        document.getElementById('quantity-display').textContent = quantity + ' unit';
        
        // Limit max quantity
        const input = document.getElementById('quantity');
        if (quantity > {{ min($product->stock, 2) }}) {
            input.value = {{ min($product->stock, 2) }};
            updateTotalPrice();
        }
    }

    // Initialize
    document.getElementById('quantity').addEventListener('input', updateTotalPrice);
    document.addEventListener('DOMContentLoaded', function() {
        updateTotalPrice();
        
        // Check if quantity exceeds stock
        const quantityInput = document.getElementById('quantity');
        if (quantityInput) {
            quantityInput.addEventListener('change', function() {
                const max = parseInt(this.max);
                if (parseInt(this.value) > max) {
                    this.value = max;
                    updateTotalPrice();
                    alert('Jumlah melebihi batas maksimal!');
                }
            });
        }
        
        // Initialize file input styling
        const fileInput = document.querySelector('input[type="file"]');
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name || 'Pilih file...';
                const label = this.nextElementSibling;
                if (label && label.tagName === 'P') {
                    label.textContent = 'File terpilih: ' + fileName;
                }
            });
        }

        // Initialize payment method info based on current selection
        const currentMethod = select.value;
        if(currentMethod === 'bca') {
            buktiDiv.classList.remove('hidden');
            infoBcaDiv.classList.remove('hidden');
        } else if(currentMethod === 'tunai') {
            infoTunaiDiv.classList.remove('hidden');
        }

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
    });
</script>

<style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    
    input[type="number"] {
        -moz-appearance: textfield;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23F0B22B' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.75rem center;
        background-repeat: no-repeat;
        background-size: 1em 1em;
        padding-right: 2rem;
    }
    
    select::-ms-expand {
        display: none;
    }
</style>
@endsection