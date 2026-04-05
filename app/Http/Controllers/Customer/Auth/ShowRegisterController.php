<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ShowRegisterController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.customer.auth.signup', [
            'title' => 'Customer Sign Up',
        ]);
    }
}
