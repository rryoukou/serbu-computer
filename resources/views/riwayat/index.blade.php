@extends('layouts.user')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-6">Riwayat Pembelian</h1>

    @if($orders->isEmpty())
        <p class="text-gray-600">Belum ada riwayat pembelian.</p>
    @else
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="font-semibold text-xl">Order #{{ $order->id }}</h2>
                        <span class="text-gray-500 text-sm">{{ $order->created_at->format('d M Y H:i') }}</span>
                    </div>

                    {{-- Detail produk --}}
                    @foreach($order->items as $item)
                        <div class="flex gap-4 mb-3 items-center">
                            <img src="{{ $item->product->photo ? asset('storage/' . $item->product->photo) : 'https://via.placeholder.com/80' }}"
                                 class="w-20 h-20 object-cover rounded">
                            <div>
                                <h3 class="font-semibold">{{ $item->nama_produk }}</h3>
                                <p>Spesifikasi: {{ $item->spesifikasi }}</p>
                                <p>Jumlah: {{ $item->qty }}</p>
                                <p>Harga: Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach

                    {{-- Metode pembayaran --}}
                    <p class="mb-2"><strong>Metode pembayaran:</strong> {{ ucfirst($order->metode_pembayaran) }}</p>

                    {{-- Status --}}
                    <p class="mb-2">
                        <strong>Status:</strong>
                        @if($order->status === 'selesai')
                            <span class="text-green-600 font-semibold">Selesai ✅</span>
                        @elseif($order->status === 'menunggu_pembayaran_tunai')
                            <span class="text-yellow-600 font-semibold">Menunggu Pembayaran Tunai</span>
                            <br>
                            <span class="text-sm text-gray-500">
                                Batas waktu: {{ $order->batas_waktu->format('d M Y H:i') }}
                            </span>
                        @elseif($order->status === 'menunggu_verifikasi')
                            <span class="text-blue-600 font-semibold">Menunggu Verifikasi BCA</span>
                        @endif
                    </p>

                    {{-- Bukti bayar --}}
                    @if($order->metode_pembayaran === 'bca' && $order->bukti_bayar)
                        <div class="mt-2">
                            <strong>Bukti Bayar:</strong><br>
                            <img src="{{ asset('storage/' . $order->bukti_bayar) }}" class="w-40 h-40 object-cover rounded mt-1">
                        </div>
                    @endif

                    {{-- Pesan --}}
                    @if($order->pesan)
                        <p class="mt-2"><strong>Pesan untuk penjual:</strong> {{ $order->pesan }}</p>
                    @endif

                    {{-- Total --}}
                    <p class="mt-2 font-bold">Total Harga: Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
