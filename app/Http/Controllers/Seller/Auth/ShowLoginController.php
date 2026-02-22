<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ShowLoginController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.seller.auth.signin', [
            'title' => 'Seller Sign In',
        ]);
    }
}
