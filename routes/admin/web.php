<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->group(function () {
    Route::get('/', fn () => 'admin ok')->name('dashboard');
});
