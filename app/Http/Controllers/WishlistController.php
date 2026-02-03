<?php

namespace App\Http\Controllers;

use App\Models\Product;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = session()->get('wishlist', []);

        // ambil ID produk dari wishlist
        $productIds = array_keys($wishlist);

        // ambil data produk lengkap dari DB
        $products = Product::whereIn('id', $productIds)->get();

        return view('wishlist.index', compact('products'));
    }

    public function toggle(Product $product)
    {
        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$product->id])) {
            unset($wishlist[$product->id]);
            session()->put('wishlist', $wishlist);
            return back()->with('success', 'Produk dihapus dari wishlist');
        }

        $wishlist[$product->id] = [
            'name'  => $product->name,
            'photo' => $product->photo,
            'price' => $product->price,
        ];

        session()->put('wishlist', $wishlist);
        return back()->with('success', 'Produk ditambahkan ke wishlist');
    }
}
