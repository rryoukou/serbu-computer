<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController; // untuk search umum

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

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
| USER (PENGGUNA ONLY)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'pengguna'])->group(function () {

    // Dashboard & Profile
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Shop / Product
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

    // Search di Shop
    Route::get('/shop/search', [ShopController::class, 'searchPage'])->name('shop.search.page');
    Route::get('/shop/search/results', [ShopController::class, 'search'])->name('shop.search.results');

    // About Us
    Route::get('/about', [PagesController::class, 'about'])->name('pages.about');

    // Cart / Keranjang
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth'])->group(function() {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});


/*
|--------------------------------------------------------------------------
| SEARCH GLOBAL (misal search di navbar)
|--------------------------------------------------------------------------
*/
Route::get('/search', [ProductController::class, 'searchPage'])->name('search.page');
Route::get('/search/results', [ProductController::class, 'search'])->name('search.results');

use App\Http\Controllers\Admin\ProductController as AdminProductController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', AdminProductController::class);
});

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\RiwayatController;

Route::middleware('auth')->group(function(){
    Route::get('/checkout/{product}', [CheckoutController::class,'show'])->name('checkout.show');
    Route::post('/checkout/{product}', [CheckoutController::class,'store'])->name('checkout.store');

    Route::get('/riwayat', [RiwayatController::class,'index'])->name('riwayat.index');
});


use App\Http\Controllers\Admin\OrderController;

Route::prefix('admin')->middleware(['auth'])->group(function() {
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.status');
});



   use App\Http\Controllers\Admin\UserController;

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])
        ->name('admin.users.index');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('admin.users.destroy');
});

use App\Http\Controllers\ProductUserController;

Route::get('/products', [ProductUserController::class, 'index'])
    ->name('shop.index');

Route::get('/products/{product}', [ProductUserController::class, 'show'])
    ->name('shop.show');



Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/shop/{product}', [ShopController::class, 'show'])
    ->name('shop.show');


