<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\{
    ShowLoginController,
    LoginController,
    LogoutController
};

Route::middleware('guest:admin')->group(function () {
    Route::get('/login', ShowLoginController::class)->name('login');
    Route::post('/login', LoginController::class)->name('login.submit');
});

Route::middleware('auth:admin')->group(function () {
    Route::post('/logout', LogoutController::class)->name('logout');
});
