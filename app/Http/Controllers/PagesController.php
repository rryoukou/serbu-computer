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
                'question' => 'Apakah bisa servis laptop di Serbu Computer?',
                'answer'   => 'Tentu! Kami menerima servis berbagai merk laptop langsung di store kami di wilayah Sawojajar.'
            ],
            [
                'question' => 'Apakah laptop yang dijual bergaransi?',
                'answer'   => 'Semua unit laptop baru memiliki garansi resmi, dan untuk laptop bekas kami memberikan garansi toko agar Anda merasa aman.'
            ],
            [
                'question' => 'Apakah bisa tukar tambah laptop bekas?',
                'answer'   => 'Bisa banget! Bawa laptop lama kamu ke store Serbu Computer Sawojajar untuk pengecekan dan penaksiran harga terbaik.'
            ],
            [
                'question' => 'Bagaimana cara pemesanan laptop & aksesoris laptop?',
                'answer'   => 'Kamu bisa pesan langsung melalui website ini atau chat admin kami. Kami siap antar atau kamu bisa ambil langsung di store.'
            ],
        ];

        $gallery = [
            'images/gallery/gal1.png',
            'images/gallery/gal2.png',
            'images/gallery/gal3.png',
            'images/gallery/gal4.jpeg',
        ];

        return view('pages.home', compact('products', 'faqs', 'gallery'));
    }

    // ABOUT US
    public function about()
    {
        return view('pages.about');
    }
}
