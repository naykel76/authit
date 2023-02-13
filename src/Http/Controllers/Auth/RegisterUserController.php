<?php

namespace Naykel\Authit\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        if (view()->exists('auth.register')) {
            return view('auth.register');
        } else {
            return view('authit::auth.register');
        }
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // log in the user
        Auth::login($user);

        // this assumes that the user being registered average Joe, this may
        // not play well if you are registering admin users.
        return redirect(route('user.dashboard'));
    }
}
