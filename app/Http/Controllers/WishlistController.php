<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        // ambil wishlist dari cookie
        $wishlist = json_decode($request->cookie('wishlist', '[]'), true);

        // ambil data produk lengkap dari DB
        $products = Product::whereIn('id', $wishlist)->get();

        return view('wishlist.index', compact('products'));
    }

    public function toggle(Request $request, Product $product)
    {
        // ambil wishlist dari cookie
        $wishlist = json_decode($request->cookie('wishlist', '[]'), true);

        // jika sudah ada → hapus
        if (in_array($product->id, $wishlist)) {
            $wishlist = array_values(array_diff($wishlist, [$product->id]));

            return back()
                ->withCookie(cookie('wishlist', json_encode($wishlist), 60 * 24 * 30))
                ->with('success', 'Produk dihapus dari wishlist');
        }

        // jika belum ada → tambah
        $wishlist[] = $product->id;

        return back()
            ->withCookie(cookie('wishlist', json_encode($wishlist), 60 * 24 * 30))
            ->with('success', 'Produk ditambahkan ke wishlist');
    }
}
