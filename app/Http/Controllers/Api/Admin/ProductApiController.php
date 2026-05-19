<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Exception;

class ProductApiController extends Controller
{
    /**
     * LIST PRODUK (API)
     * Mendukung Search, Category Filter, dan Pagination
     */
    public function index(Request $request)
    {
        try {
            // Gunakan query() untuk menangkap parameter dari URL (?search=xxx)
            $search = $request->query('search');
            $category = $request->query('category');
            
            // Samakan per_page dengan request C# (kamu pakai per_page=100 di URL C#)
            $perPage = $request->query('per_page', 10);

            $products = Product::query()
                // Logic Search
                ->when($search, function ($query) use ($search) {
                    $query->where(function($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                          ->orWhere('specs', 'like', "%{$search}%")
                          ->orWhere('category', 'like', "%{$search}%");
                    });
                })
                // Logic Filter Kategori (Jika ada)
                ->when($category, function ($query) use ($category) {
                    $query->where('category', $category);
                })
                ->latest()
                ->paginate($perPage);

            return response()->json([
                'status' => true,
                'message' => 'List produk berhasil dimuat',
                'data' => $products
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memuat data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * DETAIL PRODUK
     */
    public function show($id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return response()->json(['status' => false, 'message' => 'Produk tidak ditemukan'], 404);
            }
            return response()->json(['status' => true, 'data' => $product]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * TAMBAH PRODUK
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'category'        => 'required|in:Laptop,Aksesoris',
            'specs'           => 'nullable|string',
            'price'           => 'required|numeric|min:0',
            'stock'           => 'required|integer|min:0',
            'details'         => 'nullable|string',
            'purchase_guide'  => 'nullable|string',
            'photo'           => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('products', 'public');
        }

        $product = Product::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil ditambahkan',
            'data' => $product
        ], 201);
    }

    /**
     * UPDATE PRODUK
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'category'        => 'required|in:Laptop,Aksesoris',
            'specs'           => 'nullable|string',
            'price'           => 'required|numeric|min:0',
            'stock'           => 'required|integer|min:0',
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

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil diperbarui',
            'data' => $product
        ]);
    }

    /**
     * HAPUS PRODUK
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
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