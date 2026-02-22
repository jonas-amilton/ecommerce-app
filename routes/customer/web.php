<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:customer')->group(function () {
    Route::get('/', fn() => view('pages.customer.dashboard.index', ['title' => 'Customer Dashboard']))->name('dashboard');
});
