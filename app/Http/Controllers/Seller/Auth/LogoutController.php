<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Actions\Auth\Logout;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LogoutController extends Controller
{
    public function __invoke(Request $request, Logout $logout): RedirectResponse
    {
        $logout->handle('seller', $request->session());

        return redirect()->route('seller.login');
    }
}
