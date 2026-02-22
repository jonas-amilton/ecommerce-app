<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ShowLoginController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.auth.signin', [
            'title' => 'Seller Sign In',
            'guard' => 'seller',
            'loginRoute' => 'seller.login.submit',
        ]);
    }
}
