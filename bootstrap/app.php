<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            $domain = config('app.domain');

            // ADMIN
            Route::domain("admin.{$domain}")
                ->middleware('web')
                ->name('admin.')
                ->group(base_path('routes/admin/auth.php'));

            Route::domain("admin.{$domain}")
                ->middleware('web')
                ->name('admin.')
                ->group(base_path('routes/admin/web.php'));

            // SELLER
            Route::domain("seller.{$domain}")
                ->middleware('web')
                ->name('seller.')
                ->group(base_path('routes/seller/auth.php'));

            Route::domain("seller.{$domain}")
                ->middleware('web')
                ->name('seller.')
                ->group(base_path('routes/seller/web.php'));

            // CUSTOMER
            Route::domain("customer.{$domain}")
                ->middleware('web')
                ->name('customer.')
                ->group(base_path('routes/customer/auth.php'));

            Route::domain("customer.{$domain}")
                ->middleware('web')
                ->name('customer.')
                ->group(base_path('routes/customer/web.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
