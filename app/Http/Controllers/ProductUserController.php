<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductUserController extends Controller
{
    // halaman semua produk dengan filter
    public function index(Request $request)
    {
        // Ambil parameter filter
        $category = $request->get('category');
        $search = $request->get('search');
        $minPrice = $request->get('min_price');
        $maxPrice = $request->get('max_price');
        $inStock = $request->get('in_stock');
        
        // Query produk
        $query = Product::query();
        
        // Filter berdasarkan kategori
        if ($category && in_array($category, ['Laptop', 'Aksesoris'])) {
            $query->where('category', $category);
        }
        
        // Filter berdasarkan pencarian
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('specs', 'like', '%' . $search . '%');
            });
        }
        
        // Filter berdasarkan harga minimum
        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }
        
        // Filter berdasarkan harga maksimum
        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }
        
        // Filter hanya produk yang ada stok
        if ($inStock) {
            $query->where('stock', '>', 0);
        }
        
        // Urutkan dan ambil data
        $products = $query->latest()->paginate(12);
        
        // Hitung statistik
        $totalProducts = Product::count();
        $totalLaptops = Product::where('category', 'Laptop')->count();
        $totalAccessories = Product::where('category', 'Aksesoris')->count();
        
        // Cari harga tertinggi dan terendah untuk range slider
        $maxPriceValue = Product::max('price');
        $minPriceValue = Product::min('price');
        
        return view('shop.index', compact(
            'products',
            'category',
            'search',
            'minPrice',
            'maxPrice',
            'inStock',
            'totalProducts',
            'totalLaptops',
            'totalAccessories',
            'maxPriceValue',
            'minPriceValue'
        ));
    }

    // halaman detail produk dengan produk terkait
    public function show(Product $product)
    {
        // Ambil produk terkait berdasarkan kategori yang sama
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();
            
        return view('shop.show', compact('product', 'relatedProducts'));
    }
    
    // Fungsi untuk search page (opsional)
    public function searchPage()
    {
        return view('shop.search');
    }
}