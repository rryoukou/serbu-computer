<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // kalau nanti mau ambil data produk

class ProductController extends Controller
{
    // Halaman search
    public function searchPage()
    {
        return view('products.search'); // blade: resources/views/products/search.blade.php
    }

    // Proses pencarian (submit search form)
    public function search(Request $request)
    {
        $keyword = $request->query('q');

        // Contoh ambil produk dari database
        $products = Product::where('name', 'like', "%{$keyword}%")->get();

        return view('products.search', [
            'products' => $products,
            'keyword' => $keyword,
        ]);
    }
}
