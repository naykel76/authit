<?php

namespace Naykel\Authit\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Naykel\Authit\AuthitServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view()->exists('auth.register')
            ? view('auth.register')
            : view('authit::auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $rules = [
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];

        // If the config option is set to use a single name field then use it,
        // otherwise use firstname and lastname fields.
        if (config('authit.use_single_name_field')) {
            $rules['name'] = ['required', 'string', 'max:255'];
        } else {
            $rules['firstname'] = ['required', 'string', 'max:128'];
            $rules['lastname'] = ['required', 'string', 'max:128'];
        }

        $request->validate($rules);

        if (config('authit.use_single_name_field')) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $user = User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route(AuthitServiceProvider::REDIRECT_ROUTE, absolute: false));
    }
}
