<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:seller')->group(function () {
    Route::get('/', fn () => view('pages.seller.dashboard.index', ['title' => 'Seller Dashboard']))->name('dashboard');
});
