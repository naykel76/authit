<?php

namespace Naykel\Authit\Livewire\User;

use App\Models\User;
use Livewire\Component;

class UpdateProfileFrom extends Component
{
    public User $user;
    public string $name;
    public string $first_name;
    public string $last_name;
    public string $email;

    protected function rules()
    {
        $rules = [
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->user()->id,
        ];

        if (config('authit.split_name_fields')) {
            $rules['first_name'] = ['required', 'string', 'max:128'];
            $rules['last_name'] = ['required', 'string', 'max:128'];
        } else {
            $rules['name'] = ['required', 'string', 'max:255'];
        }

        return $rules;
    }

    public function mount()
    {
        $this->user = auth()->user();

        if (config('authit.split_name_fields')) {
            $this->first_name = $this->user->first_name;
            $this->last_name = $this->user->last_name;
        } else {
            $this->name = $this->user->name;
        }

        $this->email = $this->user->email;
    }

    public function save()
    {
        $validated = $this->validate();

        $this->user->update($validated);

        $this->dispatch('notify', 'Profile saved!');
    }

    public function render()
    {
        return view('authit::user.update-profile-form');
    }
}
