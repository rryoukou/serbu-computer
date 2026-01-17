<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // Halaman About Us
    public function about()
    {
        // Pastikan ada resources/views/pages/about.blade.php
        return view('pages.about');
    }
}
