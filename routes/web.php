<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

// The root URL '/' now serves as the home page and is named 'home'
Route::get('/', [ProductController::class, 'home'])->name('home');

Route::prefix('products')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('products');
    // ... rute produk yang sudah ada ...
    Route::get('/{product}', 'show')->name('products.show'); // Letakkan ini sebelum rute dengan middleware auth jika detail produk boleh dilihat publik
});

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
require __DIR__.'/auth.php';
