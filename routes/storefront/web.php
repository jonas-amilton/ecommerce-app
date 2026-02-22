<?php

use App\Http\Controllers\Storefront\StorefrontController;
use Illuminate\Support\Facades\Route;

Route::name('storefront.')->group(function () {
    Route::get('/', [StorefrontController::class, 'home'])->name('home');
    Route::get('/catalogo', [StorefrontController::class, 'catalog'])->name('catalog');
    Route::get('/produto/{slug}', [StorefrontController::class, 'product'])->name('product.show');
    Route::get('/carrinho', [StorefrontController::class, 'cart'])->name('cart');
    Route::get('/checkout', [StorefrontController::class, 'checkout'])->name('checkout');
});
