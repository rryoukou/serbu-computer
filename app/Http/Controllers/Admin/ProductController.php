<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
   public function index(Request $request)
{
    $search = $request->search;
    $category = $request->category; // Ambil input kategori
    $perPage = $request->get('per_page', 5); 

    $products = Product::query()
        // Filter Search (Nama, Specs, dll)
        ->when($search, function ($query) use ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('specs', 'like', "%{$search}%");
            });
        })
        // Filter Kategori (Eksak)
        ->when($category, function ($query) use ($category) {
            $query->where('category', $category);
        })
        ->latest()
        ->paginate($perPage)
        ->withQueryString(); 

    return view('admin.products.index', compact('products'));
}

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'category'        => 'required|in:Laptop,Aksesoris',
            'specs'           => 'nullable|string',
            'price'           => 'required|numeric',
            'stock'           => 'required|integer',
            'details'         => 'nullable|string',
            'purchase_guide'  => 'nullable|string',
            'photo'           => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('products', 'public');
        }

        Product::create($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'category'        => 'required|in:Laptop,Aksesoris',
            'specs'           => 'nullable|string',
            'price'           => 'required|numeric',
            'stock'           => 'required|integer',
            'details'         => 'nullable|string',
            'purchase_guide'  => 'nullable|string',
            'photo'           => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }

            $data['photo'] = $request->file('photo')->store('products', 'public');
        }

        $product->update($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}
