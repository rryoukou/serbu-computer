@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Riwayat Pembelian Admin</h1>

@if($orders->isEmpty())
    <p>Belum ada riwayat.</p>
@else
    <div class="space-y-4">
        @foreach($orders as $order)
            <div class="p-4 bg-white rounded shadow">
                <p><strong>Pembeli:</strong> {{ $order->nama_lengkap }} ({{ $order->user->email ?? 'N/A' }})</p>

                <p><strong>Produk:</strong>
                    @foreach($order->items as $item)
                        {{ $item->nama_produk }} ({{ $item->qty }})<br>
                    @endforeach
                </p>

                <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_harga,0,',','.') }}</p>
                <p><strong>Metode Pembayaran:</strong> {{ ucfirst($order->metode_pembayaran) }}</p>
                <p><strong>Status:</strong> {{ str_replace('_',' ',$order->status) }}</p>

                @if($order->batas_waktu)
                    <p><strong>Batas Waktu Pembayaran:</strong>
                        {{ \Carbon\Carbon::parse($order->batas_waktu)->format('d/m/Y H:i') }}
                    </p>
                @endif

                {{-- Bukti Transfer --}}
                @if($order->bukti_bayar)
                    <p><strong>Bukti Pembayaran:</strong></p>
                    <img src="{{ asset('storage/' . $order->bukti_bayar) }}"
                         class="w-32 mt-2 rounded cursor-pointer"
                         onclick="toggleImage(this)">
                @endif

                {{-- Form Ganti Status --}}
                <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="mt-3">
                    @csrf
                    <select name="status" class="border px-2 py-1 rounded">
                        <option value="belum_selesai" {{ $order->status === 'belum_selesai' ? 'selected' : '' }}>Belum Selesai</option>
                        <option value="selesai" {{ $order->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <button type="submit" class="ml-2 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                        Ubah Status
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endif

<script>
function toggleImage(img) {
    if(img.style.position === "fixed") {
        img.style.position = "";
        img.style.top = "";
        img.style.left = "";
        img.style.width = "8rem";
        img.style.height = "";
        img.style.zIndex = "";
    } else {
        img.style.position = "fixed";
        img.style.top = "50%";
        img.style.left = "50%";
        img.style.transform = "translate(-50%, -50%)";
        img.style.width = "50%";
        img.style.height = "auto";
        img.style.zIndex = "9999";
    }
}
</script>

@endsection
