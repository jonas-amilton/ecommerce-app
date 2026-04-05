<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Actions\Auth\Register;
use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\Auth\RegisterRequest;
use App\Models\Seller;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request, Register $register): RedirectResponse
    {
        $register->handle('seller', Seller::class, $request->safe()->all(), $request->session());

        return redirect()->route('seller.dashboard');
    }
}
