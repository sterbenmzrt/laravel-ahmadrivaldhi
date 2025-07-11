<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CouponController; 

Route::get('/', [ProductController::class, 'home'])->name('home');

Route::prefix('products')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('products');
    Route::get('/{product}', 'show')->name('products.show');
});

Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/about-us', [PageController::class, 'about'])->name('about');

// Grup untuk Rute yang Membutuhkan Autentikasi
Route::middleware('auth')->group(function () {
    Route::prefix('products')->controller(ProductController::class)->group(function () {
        Route::get('/create', 'create')->name('products.create');
        Route::post('/', 'store')->name('products.store');
        Route::get('/{product}/edit', 'edit')->name('products.edit');
        Route::put('/{product}', 'update')->name('products.update');
        Route::delete('/{product}', 'destroy')->name('products.destroy');
    });

    // Rute Keranjang Belanja
    Route::prefix('cart')->controller(CartController::class)->name('cart.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/add/{product}', 'add')->name('add');
        Route::patch('/update/{cartItem}', 'update')->name('update');
        Route::delete('/remove/{cartItem}', 'remove')->name('remove');
        Route::post('/apply-coupon', 'applyCoupon')->name('applyCoupon');
        Route::post('/remove-coupon', 'removeCoupon')->name('removeCoupon');
    });

    // Rute Checkout
    Route::prefix('checkout')->controller(CheckoutController::class)->name('checkout.')->group(function () {
        Route::get('/', 'create')->name('create');
        Route::post('/', 'store')->name('store');
    });

    // Rute Order History
    Route::prefix('orders')->controller(OrderController::class)->name('orders.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{order}', 'show')->name('show');
    });

    // Rute Wishlist
    Route::prefix('wishlist')->controller(WishlistController::class)->name('wishlist.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/toggle/{product}', 'toggle')->name('toggle');
    });
});


// Rute autentikasi dari Laravel Breeze
require __DIR__ . '/auth.php';
