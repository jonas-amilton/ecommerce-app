<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:customer')->group(function () {
    Route::get('/', fn() => 'customer ok')->name('dashboard');
});
