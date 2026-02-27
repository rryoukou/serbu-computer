@extends('layouts.admin')

@section('page_title', 'Add New Transaction')

@section('content')
<div class="max-w-4xl mx-auto px-4 pb-20">
    
    {{-- HEADER --}}
    <div class="mb-8 flex items-center justify-between reveal-anim" style="animation-delay: 0.1s">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.orders.index') }}" 
               class="p-2.5 bg-white/5 text-[#F0B22B] rounded-xl hover:bg-[#F0B22B] hover:text-[#090069] transition-all shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            </a>
            <div>
                <h2 class="text-white text-xl md:text-2xl font-bold tracking-tight">
                    Tambah Transaksi Offline
                </h2>
                <p class="text-gray-400 text-[10px] md:text-xs uppercase tracking-widest mt-1">
                    Input transaksi pembeli langsung di toko
                </p>
            </div>
        </div>
    </div>

    {{-- CARD FORM --}}
    <div class="reveal-anim bg-white/5 backdrop-blur-md rounded-[28px] border border-white/10 p-6 md:p-8 shadow-2xl" style="animation-delay: 0.2s">
        
        <form action="{{ route('admin.orders.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- PRODUK & QTY --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 space-y-2">
                    <label class="text-[#F0B22B] text-[10px] md:text-xs font-bold uppercase tracking-wider ml-1">
                        Pilih Produk
                    </label>
                    <div class="relative">
                        <select name="product_id" id="productSelect" required
                            class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3.5 text-white focus:outline-none focus:border-[#F0B22B] appearance-none cursor-pointer transition-all">
                            <option value="" class="bg-[#090069]">-- Pilih Produk --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}"
                                    data-price="{{ $product->price }}"
                                    data-stock="{{ $product->stock }}"
                                    class="bg-[#090069]">
                                    {{ $product->name }} (Stok: {{ $product->stock }})
                                </option>
                            @endforeach
                        </select>
                        <svg class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-[#F0B22B]" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="m6 9 6 6 6-6"/></svg>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-[10px] md:text-xs font-bold uppercase tracking-wider ml-1">
                        Jumlah (Qty)
                    </label>
                    <input type="number" name="qty" id="qtyInput" min="1" value="1" required
                        class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3.5 text-white focus:outline-none focus:border-[#F0B22B] transition-all">
                </div>
            </div>

            {{-- HARGA & TOTAL --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-[10px] md:text-xs font-bold uppercase tracking-wider ml-1">
                        Harga Satuan
                    </label>
                    <div class="relative">
                        <input type="text" id="hargaDisplay" readonly
                            class="w-full bg-black/30 border border-white/5 rounded-2xl px-5 py-3.5 text-gray-400 font-medium cursor-not-allowed" placeholder="Rp 0">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-[10px] md:text-xs font-bold uppercase tracking-wider ml-1">
                        Total Harga
                    </label>
                    <div class="relative">
                        <input type="text" id="totalDisplay" readonly
                            class="w-full bg-[#F0B22B]/5 border border-[#F0B22B]/20 rounded-2xl px-5 py-3.5 text-[#F0B22B] font-black text-lg cursor-not-allowed" placeholder="Rp 0">
                        <input type="hidden" name="total_harga" id="totalInput">
                    </div>
                </div>
            </div>

            {{-- PEMBAYARAN --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-[10px] md:text-xs font-bold uppercase tracking-wider ml-1">
                        Metode Pembayaran
                    </label>
                    <div class="relative">
                        <select name="metode_pembayaran" id="paymentMethod"
                            class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3.5 text-white focus:outline-none focus:border-[#F0B22B] appearance-none cursor-pointer transition-all">
                            <option value="tunai" class="bg-[#090069]">Tunai / Cash</option>
                            <option value="bca" class="bg-[#090069]">Transfer BCA</option>
                        </select>
                        <svg class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-[#F0B22B]" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="m6 9 6 6 6-6"/></svg>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-[10px] md:text-xs font-bold uppercase tracking-wider ml-1">
                        Status Transaksi
                    </label>
                    <div class="relative">
                        <select name="status" id="statusSelect"
                            class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3.5 text-white focus:outline-none focus:border-[#F0B22B] appearance-none cursor-pointer transition-all">
                            <option value="menunggu_pembayaran_tunai" class="bg-[#090069]">Menunggu Pembayaran</option>
                            <option value="menunggu_verifikasi" class="bg-[#090069]">Menunggu Verifikasi</option>
                            <option value="selesai" class="bg-[#090069]">Selesai (Lunas)</option>
                        </select>
                        <svg class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-[#F0B22B]" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="m6 9 6 6 6-6"/></svg>
                    </div>
                </div>
            </div>

            {{-- UPLOAD BUKTI (Dashed Box) --}}
            <div id="buktiWrapper" class="hidden reveal-anim">
                <div class="p-6 bg-white/5 rounded-[24px] border-2 border-dashed border-white/10 group hover:border-[#F0B22B]/50 transition-all">
                    <div class="flex flex-col md:flex-row items-center gap-6">
                        <div class="w-16 h-16 bg-[#F0B22B]/10 rounded-2xl flex items-center justify-center text-[#F0B22B] shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                        </div>
                        <div class="flex-grow w-full text-center md:text-left">
                            <p class="text-white font-bold text-sm mb-2">Upload Bukti Transfer</p>
                            <input type="file" name="bukti_bayar" id="buktiInput"
                                accept="image/*"
                                class="block w-full text-xs text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-xl file:border-0
                                file:text-[10px] file:font-black
                                file:bg-[#F0B22B] file:text-[#090069]
                                file:uppercase file:tracking-widest
                                hover:file:brightness-110 cursor-pointer transition-all">
                            <p class="text-[9px] text-gray-500 mt-3 uppercase tracking-tighter">*Format: JPG, PNG, WEBP (Max 5MB)</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SUBMIT --}}
            <div class="pt-6 flex justify-end">
                <button type="submit"
                    class="w-full md:w-auto min-w-[220px] px-8 py-4 bg-[#F0B22B] text-[#090069] rounded-2xl font-black uppercase tracking-wider hover:brightness-110 active:scale-95 transition-all shadow-xl shadow-[#F0B22B]/20">
                    Simpan Transaksi
                </button>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    const productSelect = document.getElementById('productSelect');
    const qtyInput = document.getElementById('qtyInput');
    const hargaDisplay = document.getElementById('hargaDisplay');
    const totalDisplay = document.getElementById('totalDisplay');
    const totalInput = document.getElementById('totalInput');
    const paymentMethod = document.getElementById('paymentMethod');
    const buktiWrapper = document.getElementById('buktiWrapper');
    const buktiInput = document.getElementById('buktiInput');
    const statusSelect = document.getElementById('statusSelect');

    function formatRupiah(angka) {
        return "Rp " + Number(angka).toLocaleString('id-ID');
    }

    function calculateTotal() {
        const selected = productSelect.options[productSelect.selectedIndex];
        if (!selected || !selected.getAttribute('data-price')) {
            hargaDisplay.value = "";
            totalDisplay.value = "";
            totalInput.value = "";
            return;
        }

        const price = parseInt(selected.getAttribute('data-price'));
        const stock = parseInt(selected.getAttribute('data-stock'));
        let qty = parseInt(qtyInput.value) || 1;

        if (qty > stock) {
            qty = stock;
            qtyInput.value = stock;
            alert('Stok tidak mencukupi!');
        }

        if (qty < 1) {
            qty = 1;
            qtyInput.value = 1;
        }

        const total = price * qty;
        hargaDisplay.value = formatRupiah(price);
        totalDisplay.value = formatRupiah(total);
        totalInput.value = total;
    }

    function togglePaymentUI() {
        if (paymentMethod.value === 'bca') {
            buktiWrapper.classList.remove('hidden');
            buktiInput.setAttribute('required', 'required');
            statusSelect.value = 'menunggu_verifikasi';
        } else {
            buktiWrapper.classList.add('hidden');
            buktiInput.removeAttribute('required');
            buktiInput.value = '';
            statusSelect.value = 'menunggu_pembayaran_tunai';
        }
    }

    productSelect.addEventListener('change', calculateTotal);
    qtyInput.addEventListener('input', calculateTotal);
    paymentMethod.addEventListener('change', togglePaymentUI);

    togglePaymentUI();
});
</script>

<style>
@keyframes slideUpFade {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
.reveal-anim {
    opacity: 0;
    animation: slideUpFade 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

/* Custom styling for inputs */
input:focus, select:focus {
    box-shadow: 0 0 20px rgba(240, 178, 43, 0.1) !important;
}

/* Hide arrow on number input */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
@endsection