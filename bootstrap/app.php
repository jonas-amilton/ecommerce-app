<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
        $middleware->redirectGuestsTo(function (Request $request): ?string {
            if ($request->routeIs('admin.*') || str_starts_with($request->getHost(), 'admin.')) {
                return route('admin.login');
            }

            if ($request->routeIs('seller.*') || str_starts_with($request->getHost(), 'seller.')) {
                return route('seller.login');
            }

            if ($request->routeIs('customer.*') || str_starts_with($request->getHost(), 'customer.')) {
                return route('customer.login');
            }

            return route('signin');
        });

        $middleware->redirectUsersTo(function (Request $request): ?string {
            if ($request->routeIs('admin.*') || str_starts_with($request->getHost(), 'admin.')) {
                return route('admin.dashboard');
            }

            if ($request->routeIs('seller.*') || str_starts_with($request->getHost(), 'seller.')) {
                return route('seller.dashboard');
            }

            if ($request->routeIs('customer.*') || str_starts_with($request->getHost(), 'customer.')) {
                return route('customer.dashboard');
            }

            return route('dashboard');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
