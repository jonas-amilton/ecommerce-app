<?php

namespace App\Actions\Auth;

use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

final class Register
{
    public function handle(
        string $guard,
        string $model,
        array $data,
        Session $session
    ): void {
        $email = $data['email'];

        if ($model::query()->where('email', $email)->exists()) {
            throw ValidationException::withMessages([
                'email' => __('validation.unique', ['attribute' => 'email']),
            ]);
        }

        $user = $model::query()->create([
            'name'     => $data['first_name'] . ' ' . $data['last_name'],
            'email'    => $email,
            'password' => $data['password'],
        ]);

        auth()->guard($guard)->login($user);

        $session->regenerate();
    }
}
