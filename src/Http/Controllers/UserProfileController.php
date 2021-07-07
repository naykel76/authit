<?php

namespace Naykel\Authit\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{

    /**
     * Show the user dashboard view
     */
    public function dashboard()
    {
        return view('authit::dashboard');
    }

    /**
     * Show the user profile screen.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function show(Request $request)
    {

        return view('authit::profile.show');
        // return view('profile.show', [
        //     'request' => $request,
        //     'user' => $request->user(),
        // ]);
    }

    /**
     * Validate and update the given user's profile information.
     *  
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ])->validateWithBag('updateProfile');


        $user->update($validatedData);

        // $user->sendEmailVerificationNotification();

        return back()->with('flash', 'Profile Updated');
    }
}
