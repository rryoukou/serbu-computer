<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductUserController extends Controller
{
    // halaman semua produk dengan filter + sorting
    public function index(Request $request)
    {
        // Ambil parameter filter
        $category   = $request->get('category');
        $search     = $request->get('search');
        $minPrice   = $request->get('min_price');
        $maxPrice   = $request->get('max_price');
        $inStock    = $request->get('in_stock');
        $sort       = $request->get('sort', 'newest'); // 🔥 default newest

        // Query produk
        $query = Product::query();

        // ================= FILTER =================

        // Filter kategori
        if ($category && in_array($category, ['Laptop', 'Aksesoris'])) {
            $query->where('category', $category);
        }

        // Filter pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('specs', 'like', '%' . $search . '%');
            });
        }

        // Filter harga minimum
        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }

        // Filter harga maksimum
        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }

        // Filter stok
        if ($inStock) {
            $query->where('stock', '>', 0);
        }

        // ================= SORTING =================

        $sortOptions = [
            'price-low'  => ['price', 'asc'],
            'price-high' => ['price', 'desc'],
            'name'       => ['name', 'asc'],
        ];

        if (array_key_exists($sort, $sortOptions)) {
            [$column, $direction] = $sortOptions[$sort];
            $query->orderBy($column, $direction);
        } else {
            $query->latest(); // default newest
        }

        // Ambil data + jaga query string
        $products = $query->paginate(12)->withQueryString();

        // ================= STATISTIK =================

        $totalProducts    = Product::count();
        $totalLaptops     = Product::where('category', 'Laptop')->count();
        $totalAccessories = Product::where('category', 'Aksesoris')->count();

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
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('shop.show', compact('product', 'relatedProducts'));
    }

    // halaman search (opsional)
    public function searchPage()
    {
        return view('shop.search');
    }
}