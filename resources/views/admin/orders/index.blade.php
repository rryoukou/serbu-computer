@extends('layouts.admin')

@section('page_title', 'Transaction Management')

@section('content')
<div class="mb-8 space-y-6">
    {{-- BARIS 1: JUDUL --}}
    <div>
        <h2 class="text-white text-2xl font-bold tracking-tight">Transaction Management</h2>
        <p class="text-gray-400 text-sm mt-1 uppercase tracking-widest">
            Manajemen Transaksi Serbu Comp
        </p>
    </div>

    {{-- BARIS 2: SEARCH & INFO (TURUN LEVEL) --}}
    <div class="flex flex-col md:flex-row items-center justify-between gap-4 bg-white/5 p-4 rounded-2xl border border-white/10">
        
        {{-- SEARCH --}}
        <form method="GET" class="w-full md:w-96">
            <div class="relative">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama user / status / ID order..."
                    class="w-full bg-[#090069] border border-white/10 rounded-xl pl-10 pr-4 py-2.5 text-sm text-white focus:border-[#F0B22B] focus:outline-none transition-all"
                >
                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </div>
            </div>
        </form>

        {{-- TOTAL PESANAN --}}
        <div class="flex items-center gap-3 bg-[#F0B22B]/10 px-4 py-2 rounded-xl border border-[#F0B22B]/20 w-full md:w-auto justify-center">
            <span class="w-2 h-2 rounded-full bg-[#F0B22B] animate-pulse"></span>
            <span class="text-[#F0B22B] text-xs font-bold uppercase tracking-wider">
                {{ $orders->count() }} Total Pesanan
            </span>
        </div>
    </div>
</div>

@if($orders->isEmpty())
    <div class="bg-white/5 border border-white/10 rounded-[32px] p-20 text-center">
        <div class="bg-white/5 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/>
                <path d="M3 6h18"/>
                <path d="M16 10a4 4 0 0 1-8 0"/>
            </svg>
        </div>
        <p class="text-gray-400 font-medium">Belum ada riwayat transaksi saat ini.</p>
    </div>
@else
    <div class="space-y-6">
        @foreach($orders as $order)
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-[28px] overflow-hidden hover:border-[#F0B22B]/30 transition-all group shadow-xl">
                <div class="p-6 md:p-8">
                    <div class="flex flex-col lg:flex-row gap-8">
                        
                        <div class="flex-1 space-y-4">
                            <div class="flex items-start justify-between">
                                <div class="space-y-1">
                                    <p class="text-[#F0B22B] text-[10px] font-black uppercase tracking-widest">Customer</p>
                                    <h3 class="text-white text-lg font-bold">{{ $order->nama_lengkap }}</h3>
                                    <p class="text-gray-500 text-xs">{{ $order->user->email ?? 'Guest Account' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[#F0B22B] text-[10px] font-black uppercase tracking-widest">Total Harga</p>
                                    <p class="text-white text-xl font-black italic">Rp {{ number_format($order->total_harga,0,',','.') }}</p>
                                </div>
                            </div>

                            {{-- ITEM PRODUK --}}
                            <div class="p-4 bg-black/20 rounded-2xl border border-white/5">
                                <p class="text-[#F0B22B] text-[10px] font-black uppercase tracking-widest mb-2">Item Produk</p>
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-300 font-medium">{{ $order->nama_produk }}</span>
                                        <span class="text-[#F0B22B] font-bold">x{{ $order->qty }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex-1 border-t lg:border-t-0 lg:border-l border-white/10 pt-6 lg:pt-0 lg:pl-8 space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-gray-500 text-[10px] font-bold uppercase mb-1 tracking-tight">Payment Method</p>
                                    <p class="text-white text-sm font-semibold italic uppercase">{{ str_replace('_',' ',$order->metode_pembayaran) }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-[10px] font-bold uppercase mb-1 tracking-tight">Order Status</p>
                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $order->status === 'selesai' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400 animate-pulse' }}">
                                        {{ str_replace('_',' ',$order->status) }}
                                    </span>
                                </div>
                            </div>

                            @if($order->bukti_bayar)
                                <div>
                                    <p class="text-gray-500 text-[10px] font-bold uppercase mb-2">Bukti Pembayaran</p>
                                    <div class="relative w-24 h-24 rounded-xl overflow-hidden border-2 border-white/10 hover:border-[#F0B22B] transition-all cursor-zoom-in group/img" onclick="toggleImage(this)">
                                        <img src="{{ asset('storage/' . $order->bukti_bayar) }}" class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover/img:opacity-100 flex items-center justify-center transition-all text-[8px] text-white font-bold uppercase">View Large</div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="flex flex-col justify-between items-end gap-6 border-t lg:border-t-0 lg:border-l border-white/10 pt-6 lg:pt-0 lg:pl-8">
                            <div class="text-right w-full">
                                <p class="text-gray-500 text-[10px] font-bold uppercase mb-3">Update Order Status</p>
                                <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="flex flex-col sm:flex-row gap-2">
                                    @csrf
                                    <select name="status" class="bg-[#090069] border border-white/10 rounded-xl px-3 py-2 text-xs text-white focus:border-[#F0B22B] focus:outline-none cursor-pointer">
                                        <option value="menunggu_pembayaran_tunai" {{ $order->status === 'menunggu_pembayaran_tunai' ? 'selected' : '' }}>Menunggu Pembayaran Tunai</option>
                                        <option value="menunggu_verifikasi" {{ $order->status === 'menunggu_verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                        <option value="selesai" {{ $order->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                    <button type="submit" class="bg-[#F0B22B] text-[#090069] px-4 py-2 rounded-xl text-[10px] font-black uppercase hover:scale-105 active:scale-95 transition-all">
                                        Apply
                                    </button>
                                </form>
                            </div>
                            <div class="text-right italic">
                                <p class="text-gray-600 text-[10px] uppercase font-bold">Batas Waktu</p>
                                <p class="text-gray-400 text-xs font-medium">{{ $order->batas_waktu ? \Carbon\Carbon::parse($order->batas_waktu)->format('d M, H:i') : '-' }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

<style>
/* Smooth Zoom Effect */
.modal-overlay {
    position: fixed; top:0; left:0; width:100%; height:100%;
    background: rgba(9, 0, 105, 0.95);
    z-index: 9999; display: flex; align-items: center; justify-content: center;
    cursor: zoom-out; animation: fadeIn 0.3s ease;
}
.modal-overlay img { max-width: 90%; max-height: 90%; border-radius: 20px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); }
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
</style>

<script>
function toggleImage(el) {
    const imgSrc = el.querySelector('img').src;
    const overlay = document.createElement('div');
    overlay.className = 'modal-overlay';
    overlay.innerHTML = `<img src="${imgSrc}">`;
    overlay.onclick = () => overlay.remove();
    document.body.appendChild(overlay);
}
</script>
@endsection