<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\Auth\{
    ShowLoginController,
    LoginController,
    LogoutController
};

Route::middleware('guest:customer')->group(function () {
    Route::get('/login', ShowLoginController::class)->name('login');
    Route::post('/login', LoginController::class)->name('login.submit');
});

Route::middleware('auth:customer')->group(function () {
    Route::post('/logout', LogoutController::class)->name('logout');
});
