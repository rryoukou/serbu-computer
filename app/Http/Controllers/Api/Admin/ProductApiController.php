<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductApiController extends Controller
{
    /**
     * ================================
     * LIST PRODUK (API)
     * ================================
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $perPage = $request->get('per_page', 5);

        $products = Product::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('category', 'like', "%{$search}%")
                      ->orWhere('specs', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate($perPage);

        return response()->json([
            'status' => true,
            'message' => 'List produk',
            'data' => $products
        ]);
    }

    /**
     * ================================
     * DETAIL PRODUK (API)
     * ================================
     */
    public function show(Product $product)
    {
        return response()->json([
            'status' => true,
            'data' => $product
        ]);
    }

    /**
     * ================================
     * TAMBAH PRODUK (API)
     * ================================
     */
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
            $data['photo'] = $request->file('photo')
                ->store('products', 'public');
        }

        $product = Product::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil ditambahkan',
            'data' => $product
        ], 201);
    }

    /**
     * ================================
     * UPDATE PRODUK (API)
     * ================================
     */
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

            $data['photo'] = $request->file('photo')
                ->store('products', 'public');
        }

        $product->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil diperbarui',
            'data' => $product
        ]);
    }

    /**
     * ================================
     * HAPUS PRODUK (API)
     * ================================
     */
    public function destroy(Product $product)
    {
        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil dihapus'
        ]);
    }
}