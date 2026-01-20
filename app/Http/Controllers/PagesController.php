<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PagesController extends Controller
{
    // HOME (GUEST & USER)
    public function home()
    {
        // ambil beberapa produk untuk halaman home
        $products = Product::latest()->take(6)->get();

        return view('pages.home', compact('products'));
    }

    // ABOUT US
    public function about()
    {
        return view('pages.about');
    }
}
