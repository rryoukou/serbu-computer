<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Tampilkan halaman keranjang
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Tambah produk ke keranjang
    public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $newQty = $cart[$product->id]['qty'] + 1;

            // Pastikan qty tidak lebih dari 2 dan tidak lebih dari stok
            if ($newQty > 2) {
                return back()->with('error', 'Pembelian maksimal 2 untuk produk yang sama');
            }
            if ($newQty > $product->stock) {
                return back()->with('error', 'Stok produk tidak mencukupi');
            }

            $cart[$product->id]['qty'] = $newQty;
        } else {
            if ($product->stock < 1) {
                return back()->with('error', 'Stok produk habis');
            }
            $cart[$product->id] = [
                'name'  => $product->name,
                'price' => $product->price,
                'photo' => $product->photo,
                'qty'   => 1,
            ];
        }

        session()->put('cart', $cart);
        session()->put('cart_count', array_sum(array_column($cart, 'qty')));

        return back()->with('success', 'Produk ditambahkan ke keranjang');
    }

    // Update qty produk di keranjang
    public function update(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $qty = (int) $request->qty;

            // Validasi qty
            if ($qty < 1) $qty = 1;
            if ($qty > 2) $qty = 2;
            if ($qty > $product->stock) {
                $qty = $product->stock;
                return back()->with('error', 'Qty melebihi stok produk, otomatis disesuaikan');
            }

            $cart[$product->id]['qty'] = $qty;
            session()->put('cart', $cart);
            session()->put('cart_count', array_sum(array_column($cart, 'qty')));
        }

        return back()->with('success', 'Keranjang diperbarui');
    }

    // Hapus produk dari keranjang
    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
            session()->put('cart_count', array_sum(array_column($cart, 'qty')));
        }

        return back()->with('success', 'Produk dihapus dari keranjang');
    }
}
