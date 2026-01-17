@extends('layouts.user')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-10">
    <h1 class="text-3xl font-bold mb-6">Keranjang Belanja</h1>

    @if(session('cart') && count(session('cart')) > 0)
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 text-left">Produk</th>
                    <th class="p-3 text-left">Harga</th>
                    <th class="p-3 text-left">Qty</th>
                    <th class="p-3 text-left">Total</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach(session('cart') as $id => $item)
                    @php
                        $total = $item['price'] * $item['qty'];
                        $grandTotal += $total;
                    @endphp
                    <tr class="border-b">
                        <td class="p-3 flex items-center gap-3">
                            <img src="{{ $item['photo'] ? asset('storage/' . $item['photo']) : 'https://via.placeholder.com/80' }}"
                                 class="w-16 h-16 object-cover rounded">
                            <span>{{ $item['name'] }}</span>
                        </td>
                        <td class="p-3">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td class="p-3">
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" max="{{ $item['stock'] ?? 2 }}"
                                       class="w-16 border rounded px-2 py-1">
                                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                    Update
                                </button>
                            </form>
                        </td>
                        <td class="p-3">Rp {{ number_format($total, 0, ',', '.') }}</td>
                        <td class="p-3">
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-right font-bold p-3">Grand Total</td>
                    <td colspan="2" class="font-bold p-3">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-6 text-right">
            <form action="{{ route('checkout.show', array_key_first(session('cart'))) }}" method="GET">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">
                    Checkout
                </button>
            </form>
        </div>

    @else
        <p class="text-gray-600">Keranjangmu kosong.</p>
    @endif
</div>
@endsection
