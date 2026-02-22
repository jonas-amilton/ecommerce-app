<?php

use Illuminate\Support\Facades\Route;

$domain = config('app.domain');

Route::domain($domain)->group(function () {
    require __DIR__ . '/storefront/web.php';

    Route::get('/signin', fn () => redirect()->route('customer.login'))->name('signin');
    Route::get('/signup', fn () => redirect()->route('customer.login'));
});




















