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
     * Show the edit profile screen.
     */
    public function edit()
    {
        return view('authit::user.edit');
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
