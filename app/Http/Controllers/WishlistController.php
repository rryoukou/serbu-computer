<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{


    /**
     * Tampilkan semua produk di wishlist user yang sedang login
     */
    public function index()
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->get();

        // ambil hanya data produk untuk blade
        $products = $wishlists->pluck('product');

        return view('wishlist.index', compact('products'));
    }

    /**
     * Toggle wishlist: jika sudah ada hapus, jika belum ada tambah
     */
    public function toggle(Request $request, Product $product)
    {
        $userId = Auth::id();

        // cek apakah produk sudah ada di wishlist user
        $wishlistItem = Wishlist::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        if ($wishlistItem) {
            // hapus dari wishlist
            $wishlistItem->delete();
            return back()->with('success', 'Produk dihapus dari wishlist');
        }

        // tambahkan ke wishlist
        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $product->id,
        ]);

        return back()->with('success', 'Produk ditambahkan ke wishlist');
    }
}
