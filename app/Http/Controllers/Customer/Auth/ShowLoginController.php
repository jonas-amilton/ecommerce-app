<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ShowLoginController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.customer.auth.signin', [
            'title' => 'Customer Sign In',
        ]);
    }
}
