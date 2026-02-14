<?php

namespace App\Actions\Auth;

use Illuminate\Contracts\Session\Session;
use Illuminate\Validation\ValidationException;

final class AttemptLogin
{
    public function handle(
        string $guard,
        array $credentials,
        bool $remember,
        Session $session
    ): void {
        if (! auth()->guard($guard)->attempt($credentials, $remember)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $session->regenerate();
    }
}
