@extends('layouts.admin')

@section('page_title', 'Add New Transaction')

@section('content')
<div class="max-w-4xl mx-auto px-4 pb-20">
    
    {{-- HEADER --}}
    <div class="mb-8 flex items-center justify-between reveal-anim" style="animation-delay: 0.1s">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.orders.index') }}" 
               class="p-2.5 bg-white/5 text-[#F0B22B] rounded-xl hover:bg-[#F0B22B] hover:text-[#090069] transition-all shadow-md">
                ←
            </a>
            <div>
                <h2 class="text-white text-xl md:text-2xl font-bold tracking-tight">
                    Tambah Transaksi Offline
                </h2>
                <p class="text-gray-400 text-[10px] md:text-xs uppercase tracking-widest mt-1">
                    Input transaksi pembeli langsung
                </p>
            </div>
        </div>
    </div>

    {{-- FORM --}}
    <div class="reveal-anim bg-white/5 backdrop-blur-md rounded-[28px] border border-white/10 p-6 md:p-8 shadow-2xl" style="animation-delay: 0.2s">
        
        <form action="{{ route('admin.orders.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- PILIH USER --}}
            <div class="space-y-2">
                <label class="text-[#F0B22B] text-xs font-bold uppercase tracking-wider">
                    Pilih User (Opsional)
                </label>
                <select name="user_id"
                    class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3 text-white focus:border-[#F0B22B]">
                    <option value="">Pembeli Offline (Tanpa Akun)</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->username }} - {{ $user->email }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- PRODUK & QTY --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-xs font-bold uppercase tracking-wider">
                        Produk
                    </label>
                    <select name="product_id" id="productSelect"
                        class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3 text-white focus:border-[#F0B22B]">
                        <option value="">-- Pilih Produk --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}"
                                data-price="{{ $product->price }}"
                                data-stock="{{ $product->stock }}">
                                {{ $product->name }} (Stok: {{ $product->stock }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-xs font-bold uppercase tracking-wider">
                        Qty
                    </label>
                    <input type="number" name="qty" id="qtyInput" min="1" value="1"
                        class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3 text-white focus:border-[#F0B22B]">
                </div>
            </div>

            {{-- HARGA --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-xs font-bold uppercase tracking-wider">
                        Harga Satuan
                    </label>
                    <input type="text" id="hargaDisplay" readonly
                        class="w-full bg-black/30 border border-white/10 rounded-2xl px-5 py-3 text-white">
                </div>

                <div class="space-y-2">
                    <label class="text-[#F0B22B] text-xs font-bold uppercase tracking-wider">
                        Total Harga
                    </label>
                    <input type="text" id="totalDisplay" readonly
                        class="w-full bg-black/30 border border-white/10 rounded-2xl px-5 py-3 text-[#F0B22B] font-bold">

                    <input type="hidden" name="total_harga" id="totalInput">
                </div>
            </div>

            {{-- METODE PEMBAYARAN --}}
            <div class="space-y-2">
                <label class="text-[#F0B22B] text-xs font-bold uppercase tracking-wider">
                    Metode Pembayaran
                </label>
                <select name="metode_pembayaran" id="paymentMethod"
                    class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3 text-white focus:border-[#F0B22B]">
                    <option value="tunai">Tunai</option>
                    <option value="bca">Transfer BCA</option>
                </select>
            </div>

            {{-- UPLOAD BUKTI --}}
            <div id="buktiWrapper" class="space-y-2 hidden">
                <label class="text-[#F0B22B] text-xs font-bold uppercase tracking-wider">
                    Upload Bukti Transfer
                </label>

                <input type="file" name="bukti_bayar" id="buktiInput"
                    accept="image/png,image/jpeg,image/jpg"
                    class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3 text-white">

                <p class="text-gray-400 text-xs">
                    Format: JPG / PNG (Max 5MB)
                </p>
            </div>

            {{-- STATUS --}}
            <div class="space-y-2">
                <label class="text-[#F0B22B] text-xs font-bold uppercase tracking-wider">
                    Status
                </label>
                <select name="status" id="statusSelect"
                    class="w-full bg-[#090069]/40 border border-white/10 rounded-2xl px-5 py-3 text-white focus:border-[#F0B22B]">
                    <option value="menunggu_pembayaran_tunai">Menunggu Pembayaran Tunai</option>
                    <option value="menunggu_verifikasi">Menunggu Verifikasi</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>

            {{-- SUBMIT --}}
            <div class="pt-6 flex justify-end">
                <button type="submit"
                    class="px-8 py-3.5 bg-[#F0B22B] text-[#090069] rounded-2xl font-extrabold uppercase tracking-wider hover:brightness-110 transition-all shadow-xl shadow-[#F0B22B]/20">
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
</style>
@endsection