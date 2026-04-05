<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.header.user-dropdown', function ($view): void {
            $request = request();

            $activeGuard = match (true) {
                $request->routeIs('admin.*') || str_starts_with($request->getHost(), 'admin.') => 'admin',
                $request->routeIs('seller.*') || str_starts_with($request->getHost(), 'seller.') => 'seller',
                $request->routeIs('customer.*') || str_starts_with($request->getHost(), 'customer.') => 'customer',
                default => null,
            };

            $authenticatedUser = $activeGuard ? auth()->guard($activeGuard)->user() : null;
            $displayName = $authenticatedUser?->name ?? 'User';
            $nameParts = preg_split('/\s+/', trim($displayName));
            $candidateRoute = $activeGuard ? "{$activeGuard}.logout" : null;

            $view->with([
                'displayName' => $displayName,
                'displayShortName' => $nameParts[0] ?? $displayName,
                'displayEmail' => $authenticatedUser?->email ?? 'No email',
                'logoutRoute' => $candidateRoute && Route::has($candidateRoute) ? $candidateRoute : null,
                'menuItems' => [
                    [
                        'text' => 'Edit profile',
                        'path' => url('profile'),
                        'icon' => 'profile',
                    ],
                    [
                        'text' => 'Account settings',
                        'path' => url('chat'),
                        'icon' => 'settings',
                    ],
                    [
                        'text' => 'Support',
                        'path' => url('profile'),
                        'icon' => 'support',
                    ],
                ],
            ]);
        });
    }
}
