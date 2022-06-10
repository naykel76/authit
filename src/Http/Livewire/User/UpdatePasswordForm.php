<?php

namespace Naykel\Authit\Http\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Livewire\Component;
use Naykel\Authit\Rules\Password; // from fortify

class UpdatePasswordForm extends Component
{

    public $editing = [
        'current_password' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    public function rules()
    {
        return [
            'editing.current_password' => ['required', 'string'],
            'editing.password' => ['required', 'string', new Password, 'confirmed'],
        ];
    }

    protected $validationAttributes = [
        'editing.current_password' => 'current password',
        'editing.password' => 'password',
    ];

    public function updatePassword()
    {

        $this->withValidator(function (Validator $validator) {
            $validator->after(function ($validator) {
                if (!isset($this->editing['current_password']) || !Hash::check($this->editing['current_password'], Auth::user()->password)) {
                    $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
                }
            });
        })->validate();

        Auth::user()->forceFill([
            'password' => Hash::make($this->editing['password']),
        ])->save();


        if (request()->hasSession()) {
            request()->session()->put([
                'password_hash_' . Auth::getDefaultDriver() => Auth::user()->getAuthPassword(),
            ]);
        }

        //   reset state
        $this->editing = [];

        $this->dispatchBrowserEvent('notify', 'Password Updated!');

    }

    public function render()
    {
        return view('authit::user.update-password-form')
            ->layout('authit::user.dashboard');
    }
}
