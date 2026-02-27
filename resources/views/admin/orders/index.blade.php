@extends('layouts.admin')

@section('page_title', 'Transaction Management')

@section('content')
<div class="mb-8 space-y-6 reveal-anim" style="animation-delay: 0.1s">
    {{-- BARIS 1: JUDUL --}}
    <div>
        <h2 class="text-white text-2xl font-bold tracking-tight">Transaction Management</h2>
        <p class="text-gray-400 text-sm mt-1 uppercase tracking-widest">
            Manajemen Transaksi Serbu Comp
        </p>
    </div>

    {{-- BARIS 2: SEARCH & INFO --}}
    <div class="flex flex-col md:flex-row items-center justify-between gap-4 bg-white/5 p-4 rounded-2xl border border-white/10">
        <form method="GET" class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
            <select name="per_page" onchange="this.form.submit()" class="bg-[#090069] border border-white/10 rounded-xl px-3 py-2.5 text-sm text-white focus:border-[#F0B22B] focus:outline-none transition-all cursor-pointer">
                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>Show 5</option>
                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>Show 10</option>
                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>Show 25</option>
                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>Show 50</option>
            </select>

            <div class="relative w-full sm:w-80">
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

        <div class="flex items-center gap-3 bg-[#F0B22B]/10 px-4 py-2 rounded-xl border border-[#F0B22B]/20 w-full md:w-auto justify-center">
            <span class="w-2 h-2 rounded-full bg-[#F0B22B] animate-pulse"></span>
            <span class="text-[#F0B22B] text-xs font-bold uppercase tracking-wider">
                {{ $orders->total() }} Total Pesanan
            </span>
        </div>

        <a href="{{ route('admin.orders.create') }}" 
           class="flex items-center gap-2 bg-[#F0B22B] text-[#090069] font-black uppercase text-[10px] tracking-widest px-6 py-2.5 rounded-xl hover:scale-105 active:scale-95 transition-all shadow-lg shadow-[#F0B22B]/20">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Tambah Transaksi
        </a>

    </div>
</div>

@if($orders->isEmpty())
    <div class="reveal-anim bg-white/5 border border-white/10 rounded-[32px] p-20 text-center" style="animation-delay: 0.3s">
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
        @foreach($orders as $index => $order)
            {{-- Tambahkan index untuk delay staggered --}}
            <div class="reveal-anim bg-white/5 backdrop-blur-md border border-white/10 rounded-[28px] overflow-hidden hover:border-[#F0B22B]/30 transition-all group shadow-xl" 
                 style="animation-delay: {{ 0.2 + ($index * 0.1) }}s">
                <div class="p-6 md:p-8">
                    <div class="flex flex-col lg:flex-row gap-8">
                        
                        {{-- KOLOM KIRI: CUSTOMER --}}
                        <div class="flex-none lg:w-64 space-y-4">
                            <div class="space-y-2">
                                <div>
                                    <p class="text-[#F0B22B] text-xs font-black uppercase tracking-widest mb-1">Customer</p>
                                    <h3 class="text-white text-xl font-bold tracking-tight">{{ $order->nama_lengkap }}</h3>
                                    <p class="text-gray-400 text-sm truncate">{{ $order->user->email ?? 'Guest Account' }}</p>
                                </div>
                                <div class="pt-2">
                                    <p class="text-[#F0B22B] text-[10px] font-black uppercase tracking-widest mb-1">Total Harga</p>
                                    <p class="text-white text-2xl font-black italic tracking-tighter whitespace-nowrap">Rp {{ number_format($order->total_harga,0,',','.') }}</p>
                                </div>
                            </div>

                            <div class="p-4 bg-black/20 rounded-2xl border border-white/5">
                                <p class="text-[#F0B22B] text-[10px] font-black uppercase tracking-widest mb-2">Item Produk</p>
                                <div class="flex justify-between items-center text-sm gap-2">
                                    <span class="text-gray-300 font-medium text-base truncate">{{ $order->nama_produk }}</span>
                                    <span class="text-[#F0B22B] font-extrabold text-lg flex-none">x{{ $order->qty }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- KOLOM TENGAH: PAYMENT & STATUS --}}
                        <div class="flex-1 border-t lg:border-t-0 lg:border-l border-white/10 pt-6 lg:pt-0 lg:pl-8">
                            <div class="flex flex-col sm:flex-row gap-6 sm:gap-10">
                                <div class="min-w-fit">
                                    <p class="text-gray-500 text-[10px] font-bold uppercase mb-2 tracking-widest">Payment Method</p>
                                    <p class="text-white text-base font-bold italic uppercase whitespace-nowrap">{{ str_replace('_',' ',$order->metode_pembayaran) }}</p>
                                </div>

                                <div class="min-w-fit">
                                    <p class="text-gray-500 text-[10px] font-bold uppercase mb-2 tracking-widest">Order Status</p>
                                    <div class="flex">
                                        @php
                                            $statusClasses = match($order->status) {
                                                'selesai' => 'bg-green-500/20 text-green-400 border-green-500/30',
                                                'menunggu_verifikasi' => 'bg-blue-500/20 text-blue-400 border-blue-500/30 animate-pulse',
                                                'menunggu_pembayaran_tunai' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                                                default => 'bg-gray-500/20 text-gray-400 border-gray-500/30',
                                            };
                                        @endphp
                                        <span class="inline-flex items-center whitespace-nowrap px-4 py-2 rounded-xl border text-[11px] font-black uppercase tracking-widest {{ $statusClasses }}">
                                            <span class="w-2 h-2 rounded-full bg-current mr-2 shrink-0"></span>
                                            {{ str_replace('_',' ',$order->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            @if($order->bukti_bayar)
                                <div class="mt-8">
                                    <p class="text-gray-500 text-[10px] font-bold uppercase mb-2">Bukti Pembayaran</p>
                                    <div class="relative w-32 h-32 rounded-2xl overflow-hidden border-2 border-white/10 hover:border-[#F0B22B] transition-all cursor-zoom-in group/img shadow-2xl" onclick="toggleImage(this)">
                                        <img src="{{ asset('storage/' . $order->bukti_bayar) }}" class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover/img:opacity-100 flex flex-col items-center justify-center transition-all text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                            <span class="text-[10px] font-black uppercase">Enlarge</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- KOLOM KANAN: ACTION --}}
                        <div class="flex-none lg:w-64 flex flex-col gap-8 lg:items-end border-t lg:border-t-0 lg:border-l border-white/10 pt-6 lg:pt-0 lg:pl-8">
                            <div class="text-left lg:text-right w-full">
                                <p class="text-gray-500 text-[10px] font-bold uppercase mb-3">Update Order Status</p>
                                <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="flex flex-col gap-2">
                                    @csrf
                                    <select name="status" class="bg-[#090069] border border-white/10 rounded-xl px-3 py-2 text-xs text-white focus:border-[#F0B22B] focus:outline-none cursor-pointer">
                                        <option value="menunggu_pembayaran_tunai" {{ $order->status === 'menunggu_pembayaran_tunai' ? 'selected' : '' }}>Menunggu Pembayaran Tunai</option>
                                        <option value="menunggu_verifikasi" {{ $order->status === 'menunggu_verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                        <option value="selesai" {{ $order->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                    <button type="submit" class="bg-[#F0B22B] text-[#090069] px-4 py-2.5 rounded-xl text-[10px] font-black uppercase hover:scale-105 active:scale-95 transition-all shadow-lg shadow-[#F0B22B]/20">
                                        Apply Change
                                    </button>
                                </form>
                            </div>
                            
                            <div class="text-left lg:text-right pb-2">
                                <p class="text-gray-600 text-[10px] uppercase font-bold tracking-tighter">Batas Waktu</p>
                                <p class="text-gray-400 text-sm font-medium italic whitespace-nowrap">
                                    {{ $order->batas_waktu ? \Carbon\Carbon::parse($order->batas_waktu)->format('d M, H:i') : '-' }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if ($orders->hasPages())
        <div class="mt-10 flex justify-center custom-pagination overflow-x-auto pb-4 reveal-anim" style="animation-delay: 0.8s">
            {{ $orders->appends(['per_page' => request('per_page')])->links() }}
        </div>
    @endif
@endif

<style>
/* 1. ANIMASI REVEAL (SLIDE & FADE) */
@keyframes slideInRight {
    from { 
        opacity: 0; 
        transform: translateX(20px); 
    }
    to { 
        opacity: 1; 
        transform: translateX(0); 
    }
}

.reveal-anim {
    opacity: 0;
    animation: slideInRight 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

/* 2. MODAL BUKTI BAYAR */
.modal-overlay {
    position: fixed; top:0; left:0; width:100%; height:100%;
    background: rgba(9, 0, 105, 0.95); backdrop-filter: blur(10px);
    z-index: 9999; display: flex; align-items: center; justify-content: center;
    cursor: zoom-out; animation: fadeIn 0.3s ease;
}
.modal-overlay img { 
    max-width: 90%; 
    max-height: 85%; 
    border-radius: 24px; 
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8); 
    border: 2px solid rgba(255,255,255,0.1); 
    transform: scale(1);
    animation: zoomIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}

@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes zoomIn { from { transform: scale(0.8); opacity: 0; } to { transform: scale(1); opacity: 1; } }

/* 3. CUSTOM PAGINATION */
.custom-pagination nav svg { width: 20px; height: 20px; }
.custom-pagination nav div div span, .custom-pagination nav div div a {
    border-radius: 12px !important;
    background: rgba(255, 255, 255, 0.05) !important;
    color: white !important;
    border-color: rgba(255, 255, 255, 0.1) !important;
    margin: 0 2px;
    padding: 8px 16px !important;
    font-size: 12px;
}
.custom-pagination nav div div a:hover {
    background: rgba(240, 178, 43, 0.2) !important;
    color: #F0B22B !important;
    border-color: #F0B22B !important;
}
.custom-pagination nav div div span[aria-current="page"] > span {
    background: #F0B22B !important;
    color: #090069 !important;
    border-radius: 12px;
}
</style>

<script>
function toggleImage(el) {
    const imgSrc = el.querySelector('img').src;
    const overlay = document.createElement('div');
    overlay.className = 'modal-overlay';
    overlay.innerHTML = `
        <div class="relative flex flex-col items-center px-4">
            <img src="${imgSrc}">
            <p class="text-white font-bold mt-6 uppercase tracking-widest text-xs bg-black/50 px-8 py-3 rounded-full border border-white/10">Klik dimana saja untuk menutup</p>
        </div>
    `;
    overlay.onclick = () => overlay.remove();
    document.body.appendChild(overlay);
}
</script>
@endsection