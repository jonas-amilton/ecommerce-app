<?php

namespace App\Actions\Auth;

use Illuminate\Contracts\Session\Session;

final class Logout
{
    public function handle(string $guard, Session $session): void
    {
        auth()->guard($guard)->logout();

        $session->invalidate();
        $session->regenerateToken();
    }
}
