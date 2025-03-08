<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/detail/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::post('products/add-to-cart', [ProductController::class, 'addToCart'])->name('products.add-to-cart');

    Route::group(['prefix' => 'admin'], function () {
        Route::get('products', [ProductController::class, 'list'])->name('products.list');
        Route::get('products/add', [ProductController::class, 'add'])->name('products.add');
        Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
        Route::get('products/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
