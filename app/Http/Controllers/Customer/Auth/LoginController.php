<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Actions\Auth\AttemptLogin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request, AttemptLogin $attemptLogin): RedirectResponse
    {
        $credentials = $request->safe()->only(['email', 'password']);
        $remember = $request->boolean('remember');

        $attemptLogin->handle('customer', $credentials, $remember, $request->session());

        return redirect()->route('customer.dashboard');
    }
}
