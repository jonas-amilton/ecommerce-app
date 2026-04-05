<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Actions\Auth\Register;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Auth\RegisterRequest;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request, Register $register): RedirectResponse
    {
        $register->handle('customer', Customer::class, $request->safe()->all(), $request->session());

        return redirect()->route('customer.dashboard');
    }
}
