<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\Auth\{
    ShowLoginController,
    LoginController,
    LogoutController
};

Route::middleware('guest:seller')->group(function () {
    Route::get('/login', ShowLoginController::class)->name('login');
    Route::post('/login', LoginController::class)->name('login.submit');
});

Route::middleware('auth:seller')->group(function () {
    Route::post('/logout', LogoutController::class)->name('logout');
});
