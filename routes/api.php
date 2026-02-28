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
| PUBLIC ROUTES (Tidak Perlu Login)
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'login']);


/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (Harus Login Pakai Token)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // ========== AUTH ==========
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // ========== ADMIN ==========
    Route::prefix('admin')->group(function () {

        Route::get('/dashboard', [DashboardApiController::class, 'index']);

        // PRODUCTS
        Route::get('/products', [ProductApiController::class, 'index']);
        Route::post('/products', [ProductApiController::class, 'store']);
        Route::put('/products/{product}', [ProductApiController::class, 'update']);
        Route::delete('/products/{product}', [ProductApiController::class, 'destroy']);

        // ORDERS
        Route::get('/orders', [OrderApiController::class, 'index']);
        Route::put('/orders/{order}/status', [OrderApiController::class, 'updateStatus']);

        // USERS
        Route::get('/users', [UserApiController::class, 'index']);
        Route::put('/users/{user}/toggle-ban', [UserApiController::class, 'toggleBan']);
        Route::delete('/users/{user}', [UserApiController::class, 'destroy']);

    });
});