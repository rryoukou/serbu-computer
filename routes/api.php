<?php

use Illuminate\Support\Facades\Route;

// ================= AUTH =================
use App\Http\Controllers\Api\AuthController;

// ================= ADMIN API =================
use App\Http\Controllers\Api\Admin\DashboardApiController;
use App\Http\Controllers\Api\Admin\ProductApiController;
use App\Http\Controllers\Api\Admin\OrderApiController;
use App\Http\Controllers\Api\Admin\UserApiController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
| Bisa diakses langsung oleh C# tanpa Token Bearer.
| Cocok untuk Load Data Awal dan Transaksi Kasir (Offline).
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'login']);

Route::prefix('admin')->group(function () {
    // Produk (Agar ComboBox di C# bisa terisi)
    Route::get('/products', [ProductApiController::class, 'index']);
    
    // Simpan Transaksi Offline (Agar tombol Create di C# jalan)
    // URL di C# nanti: http://localhost:8000/api/admin/orders
    Route::post('/orders', [OrderApiController::class, 'store']); 

    // Dashboard & Monitoring
    Route::get('/orders', [OrderApiController::class, 'index']); 
    Route::get('/dashboard', [DashboardApiController::class, 'index']);
    Route::get('/users', [UserApiController::class, 'index']);
    Route::get('/users/{id}', [UserApiController::class, 'show']);

    // Update Status
    Route::put('/orders/{order}/status', [OrderApiController::class, 'updateStatus']);
});


/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES
|--------------------------------------------------------------------------
| Hanya bisa diakses jika menyertakan Token Bearer yang valid.
| Digunakan untuk manajemen data (CRUD) oleh Admin.
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    // ========== AUTH ==========
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // ========== ADMIN CRUD ==========
    Route::prefix('admin')->group(function () {

        // CRUD PRODUCTS (Tambah/Edit/Hapus barang di stok)
        Route::get('/products/{product}', [ProductApiController::class, 'show']);
        Route::post('/products', [ProductApiController::class, 'store']);
        Route::put('/products/{product}', [ProductApiController::class, 'update']);
        Route::delete('/products/{product}', [ProductApiController::class, 'destroy']);

        // USERS ACTIONS
        Route::post('/users/{id}/ban', [UserApiController::class, 'toggleBan']);
        Route::delete('/users/{id}', [UserApiController::class, 'destroy']);
    });
});