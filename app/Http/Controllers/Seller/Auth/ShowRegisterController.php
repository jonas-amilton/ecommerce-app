<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ShowRegisterController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.seller.auth.signup', [
            'title' => 'Seller Sign Up',
        ]);
    }
}
