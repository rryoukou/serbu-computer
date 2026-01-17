<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductUserController extends Controller
{
    // halaman semua produk
    public function index()
    {
        $products = Product::latest()->get();
        return view('shop.index', compact('products'));
    }

    // halaman detail produk
    public function show(Product $product)
    {
        return view('shop.show', compact('product'));
    }
}
