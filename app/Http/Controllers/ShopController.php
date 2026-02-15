<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    // Halaman utama shop
    public function index()
    {
        $products = Product::paginate(12); // ← Gunakan paginate di sini juga
        return view('shop.index', compact('products'));
    }

    // Halaman search (awal, belum submit)
    public function searchPage()
    {
        return view('products.search', [
            'products' => Product::paginate(0), // atau Product::query()->paginate(12)
            'keyword' => null,
        ]);
    }

    // Proses pencarian - INI YANG HARUS DIPERBAIKI!
    public function search(Request $request)
    {
        $query = $request->q;

        // GANTI .get() MENJADI .paginate()
        $products = Product::where('name', 'like', "%{$query}%")
            ->paginate(12); // ← INI YANG BENAR, BUKAN .get()

        return view('products.search', [
            'products' => $products,
            'keyword' => $query,
        ]);
    }

    // Detail produk
    public function show(Product $product)
    {
        return view('shop.show', compact('product'));
    }
}