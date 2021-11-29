<?php

namespace Naykel\Authit\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Livewire\Component;

class UpdatePasswordForm extends Component
{
    public $state = [
        'current_password' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    public function updatePassword(UpdatesUserPasswords $updater)
    {
        $this->resetErrorBag();

        $updater->update(Auth::user(), $this->state);

        $this->state = [
            'current_password' => '',
            'password' => '',
            'password_confirmation' => '',
        ];

        $this->dispatchBrowserEvent('notify', 'Password updated!');
    }

    public function getUserProperty()
    {
        return Auth::user();
    }

    public function render()
    {
        return view('authit::user.update-password-form')
            ->layout('authit::user.dashboard-layout');
    }
}
