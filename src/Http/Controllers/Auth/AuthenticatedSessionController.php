<?php

namespace Naykel\Authit\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Naykel\Authit\AuthitServiceProvider;
use Naykel\Authit\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        if (view()->exists('auth.login')) {
            return view('auth.login');
        } else {
            return view('authit::auth.login');
        }
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {

        $request->authenticate();

        $request->session()->regenerate();

        $intended  = auth()->user()->can('access admin')
            ? AuthitServiceProvider::ADMIN_DASHBOARD
            : AuthitServiceProvider::USER_DASHBOARD;

        return redirect()->intended($intended);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
