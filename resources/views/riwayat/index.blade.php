@extends('layouts.user')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-6">Riwayat Pembelian</h1>

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
            {{ $errors->first() }}
        </div>
    @endif

    @if($orders->isEmpty())
        <p class="text-gray-600">Belum ada riwayat pembelian.</p>
    @else
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="bg-white p-6 rounded-lg shadow">

                    {{-- HEADER --}}
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="font-semibold text-xl">Order #{{ $order->id }}</h2>
                        <span class="text-gray-500 text-sm">
                            {{ $order->created_at->format('d M Y H:i') }}
                        </span>
                    </div>

                    {{-- DETAIL PRODUK --}}
                    @foreach($order->items as $item)
                        <div class="flex gap-4 mb-3 items-center">
                            <img
                                src="{{ $item->product && $item->product->photo
                                    ? asset('storage/' . $item->product->photo)
                                    : 'https://via.placeholder.com/80' }}"
                                class="w-20 h-20 object-cover rounded">

                            <div>
                                <h3 class="font-semibold">{{ $item->nama_produk }}</h3>
                                <p class="text-sm text-gray-600">Spesifikasi: {{ $item->spesifikasi }}</p>
                                <p>Jumlah: {{ $item->qty }}</p>
                                <p>Harga: Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach

                    {{-- METODE PEMBAYARAN --}}
                    <p class="mt-2">
                        <strong>Metode Pembayaran:</strong>
                        {{ strtoupper($order->metode_pembayaran) }}
                    </p>

                    {{-- STATUS --}}
                    <p class="mt-2">
                        <strong>Status:</strong>

                        @if($order->status === 'selesai')
                            <span class="text-green-600 font-semibold">Selesai ✅</span>

                        @elseif($order->status === 'menunggu_pembayaran_tunai')
                            <span class="text-yellow-600 font-semibold">
                                Menunggu Pembayaran Tunai
                            </span>

                            @if($order->batas_waktu)
                                <br>
                                <span class="text-sm text-gray-500">
                                    Batas waktu:
                                    {{ \Carbon\Carbon::parse($order->batas_waktu)->format('d M Y H:i') }}
                                </span>
                            @endif

                        @elseif($order->status === 'menunggu_verifikasi')
                            <span class="text-blue-600 font-semibold">
                                Menunggu Verifikasi BCA
                            </span>
                        @endif
                    </p>

                    {{-- BUKTI BCA --}}
                    @if($order->metode_pembayaran === 'bca' && $order->bukti_bayar)
                        <div class="mt-3">
                            <strong>Bukti Pembayaran:</strong><br>
                            <img
                                src="{{ asset('storage/' . $order->bukti_bayar) }}"
                                class="w-40 mt-2 rounded cursor-pointer"
                                onclick="toggleImage(this)">
                        </div>
                    @endif

                    {{-- PESAN --}}
                    @if($order->pesan)
                        <p class="mt-3">
                            <strong>Pesan:</strong> {{ $order->pesan }}
                        </p>
                    @endif

                    {{-- TOTAL --}}
                    <p class="mt-4 font-bold text-lg">
                        Total Harga: Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                    </p>

                    {{-- TOMBOL HAPUS (JIKA BELUM SELESAI) --}}
                    @if($order->status !== 'selesai')
                        <form action="{{ route('riwayat.destroy', $order->id) }}"
                              method="POST"
                              class="mt-4"
                              onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                            @csrf
                            @method('DELETE')

                            <button
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                                Hapus Pesanan
                            </button>
                        </form>
                    @endif

                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- SCRIPT ZOOM GAMBAR --}}
<script>
function toggleImage(img) {
    if (img.classList.contains('zoomed')) {
        img.classList.remove('zoomed');
        img.style = '';
    } else {
        img.classList.add('zoomed');
        img.style.position = 'fixed';
        img.style.top = '50%';
        img.style.left = '50%';
        img.style.transform = 'translate(-50%, -50%)';
        img.style.width = '50%';
        img.style.zIndex = '9999';
        img.style.cursor = 'zoom-out';
    }
}
</script>
@endsection
