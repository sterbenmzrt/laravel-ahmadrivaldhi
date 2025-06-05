<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// The root URL '/' now serves as the home page and is named 'home'
Route::get('/', [ProductController::class, 'home'])->name('home');

Route::prefix('products')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('products');
    Route::get('/create', 'create')->name('products.create');
    Route::post('/', 'store')->name('products.store');
    Route::get('/{product}', 'show')->name('products.show'); // Using route model binding
    Route::get('/{product}/edit', 'edit')->name('products.edit'); // Using route model binding
    Route::put('/{product}', 'update')->name('products.update'); // Using route model binding and PUT
    Route::delete('/{product}', 'destroy')->name('products.destroy'); // Using route model binding
});

// If you have authentication routes from Laravel Breeze/Jetstream, they would typically be here:
// require __DIR__.'/auth.php';
