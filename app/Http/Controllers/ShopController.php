<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    // Halaman utama shop
    public function index()
    {
        $products = Product::all();
        return view('shop.index', compact('products'));
    }

    // Halaman search (awal, belum submit)
    public function searchPage()
    {
        return view('products.search', [
            'products' => collect(),
            'keyword' => null,
        ]);
    }

    // Proses pencarian
    public function search(Request $request)
    {
        $query = $request->q;

        $products = Product::where('name', 'like', "%{$query}%")->get();

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
