<?php

namespace Naykel\Authit\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function show(Request $request)
    {
        return view('authit::account', [
            'request' => $request,
            'user' => $request->user(),
        ]);
        // return view('account', [
        //     'request' => $request,
        //     'user' => $request->user(),
        // ]);
    }

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
