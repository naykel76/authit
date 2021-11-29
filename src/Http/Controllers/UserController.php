<?php

namespace Naykel\Authit\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    /**
     * Show the user dashboard
     */
    public function dashboard()
    {
        if (view()->exists('user.dashboard-layout')) {
            return view('user.dashboard-layout');
        } else {
            return view('authit::user.dashboard-layout');
        }
    }

    /**
     * Show the edit profile screen.
     */
    public function edit()
    {
        return view('authit::user.edit');
    }

}
