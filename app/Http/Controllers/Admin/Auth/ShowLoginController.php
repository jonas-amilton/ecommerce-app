<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ShowLoginController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.admin.auth.signin', [
            'title' => 'Admin Sign In',
        ]);
    }
}
