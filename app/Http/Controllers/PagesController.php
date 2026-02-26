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
        $products = Product::latest()->take(4)->get();

        // data FAQ (manual, tanpa database)
        $faqs = [
            [
                'question' => 'Bagaimana cara membeli produk?',
                'answer'   => 'Pilih produk yang kamu inginkan, masukkan ke keranjang, lalu lakukan checkout.'
            ],
            [
                'question' => 'Apakah produk yang dijual bergaransi?',
                'answer'   => 'Ya, semua produk kami memiliki garansi resmi sesuai ketentuan masing-masing brand.'
            ],
            [
                'question' => 'Metode pembayaran apa saja yang tersedia?',
                'answer'   => 'Kami mendukung transfer bank dan beberapa metode pembayaran digital.'
            ],
            [
                'question' => 'Berapa lama proses pengiriman?',
                'answer'   => 'Pengiriman biasanya memakan waktu 2–4 hari kerja tergantung lokasi.'
            ],
        ];

        $gallery = [
            'images/gallery/gal1.jpg',
            'images/gallery/gal2.jpg',
            'images/gallery/gal3.jpg',
            'images/gallery/gal4.jpg',
        ];

        return view('pages.home', compact('products', 'faqs', 'gallery'));
    }

    // ABOUT US
    public function about()
    {
        return view('pages.about');
    }
}
