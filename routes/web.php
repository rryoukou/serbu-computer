<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductUserController;

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| ROOT → GUEST LANGSUNG LIHAT PRODUK
|--------------------------------------------------------------------------
*/
Route::get('/', [ProductUserController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| AUTH (GUEST ONLY)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', [RegisterController::class, 'register']);
});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| GUEST & USER → LIHAT PRODUK
|--------------------------------------------------------------------------
*/
Route::get('/products', [ProductUserController::class, 'index'])
    ->name('shop.index');

Route::get('/products/{product}', [ProductUserController::class, 'show'])
    ->name('shop.show');

/*
|--------------------------------------------------------------------------
| SHOP SEARCH (WAJIB ADA, BIAR TIDAK ERROR)
|--------------------------------------------------------------------------
*/
Route::get('/shop/search', [ShopController::class, 'searchPage'])
    ->name('shop.search.page');

Route::get('/shop/search/results', [ShopController::class, 'search'])
    ->name('shop.search.results');

/*
|--------------------------------------------------------------------------
| SEARCH GLOBAL (NAVBAR)
|--------------------------------------------------------------------------
*/
Route::get('/search', [ProductController::class, 'searchPage'])
    ->name('search.page');

Route::get('/search/results', [ProductController::class, 'search'])
    ->name('search.results');

/*
|--------------------------------------------------------------------------
| USER LOGIN (PENGGUNA)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'pengguna'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::post('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    // About
    Route::get('/about', [PagesController::class, 'about'])
        ->name('pages.about');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart/add/{product}', [CartController::class, 'add'])
        ->name('cart.add');

    Route::post('/cart/update/{product}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])
        ->name('cart.remove');

    // Checkout
    Route::get('/checkout/{product}', [CheckoutController::class, 'show'])
        ->name('checkout.show');

    Route::post('/checkout/{product}', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    // Riwayat
    Route::get('/riwayat', [RiwayatController::class, 'index'])
        ->name('riwayat.index');

    Route::delete('/riwayat/{order}', [RiwayatController::class, 'destroy'])
        ->name('riwayat.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('products', AdminProductController::class);

        Route::get('/orders', [OrderController::class, 'index'])
            ->name('orders.index');

        Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])
            ->name('orders.status');

        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');

        Route::delete('/users/{user}', [UserController::class, 'destroy'])
            ->name('users.destroy');
});
