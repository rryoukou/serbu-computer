<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $faqs = [
            [
                'question' => 'Apakah tersedia layanan servis dan konsultasi?',
                'answer' => 'Ya, kami menyediakan layanan servis dan konsultasi berbayar dengan biaya terjangkau.'
            ],
            [
                'question' => 'Apakah laptop yang dijual original dan berkualitas?',
                'answer' => 'Semua laptop yang kami jual original, telah melalui proses quality control.'
            ],
            [
                'question' => 'Di mana lokasi toko Serbu Comp?',
                'answer' => 'Kami berlokasi di pusat kota dan melayani pemesanan online seluruh Indonesia.'
            ],
            [
                'question' => 'Apakah bisa COD atau ambil langsung di toko?',
                'answer' => 'Bisa. Kami menyediakan opsi COD dengan perlu menghubungi nomor kontak kami terlebih dahulu dan pengambilan langsung di toko.'
            ],
        ];

        // ✅ GALLERY (ASSET LOKAL)
        $gallery = [
            'images/gallery/gal1.jpg',
            'images/gallery/gal2.jpg',
            'images/gallery/gal3.jpg',
            'images/gallery/gal4.jpg',
        ];

        return view('dashboard.index', [
            'user'     => Auth::user(),
            'products' => Product::latest()->take(4)->get(), // ⬅️ INI YANG DIPERBAIKI
            'faqs'     => $faqs,
            'gallery'  => $gallery,
        ]);
    }
}