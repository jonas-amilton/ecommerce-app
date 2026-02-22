<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->group(function () {
    Route::get('/', fn () => view('pages.admin.dashboard.ecommerce', ['title' => 'Admin Dashboard']))->name('dashboard');
});
