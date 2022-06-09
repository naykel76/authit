<?php

namespace Naykel\Authit\Http\Controllers;

use App\Http\Controllers\Controller;

class UserController extends Controller
{

    /**
     * Show the user dashboard
     */
    public function dashboard()
    {
        if (view()->exists('user.dashboard')) {
            return view('user.dashboard');
        } else {
            return view('authit::user.dashboard');
        }
    }
}
