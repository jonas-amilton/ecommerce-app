<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:seller')->group(function () {
    Route::get('/', fn () => 'seller ok')->name('dashboard');
});
