<?php

namespace Naykel\Authit\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfileFrom extends Component
{
    use WithFileUploads;

    public User $user;
    public string $name;
    public string $first_name;
    public string $last_name;
    public string $email;

    // public $upload;

    protected function rules()
    {
        $rules = [
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->user()->id,
        ];

        // If the config option is set to use a single name field then use it,
        // otherwise use first_name and last_name fields.
        if (config('authit.use_single_name_field')) {
            $rules['name'] = ['required', 'string', 'max:255'];
        } else {
            $rules['first_name'] = ['required', 'string', 'max:128'];
            $rules['last_name'] = ['required', 'string', 'max:128'];
        }

        return $rules;
    }

    public function mount()
    {

        $this->user = auth()->user();

        if (config('authit.use_single_name_field')) {
            $this->name = $this->user->name;
        } else {
            $this->first_name = $this->user->first_name;
            $this->last_name = $this->user->last_name;
        }

        // dd($this->user->first_name);
        $this->email = $this->user->email;
    }

    public function updatedUpload() // real time validation
    {
        $this->validate(['upload' => 'nullable|image|max:1000']);
    }

    public function save()
    {
        $validated = $this->validate();

        // dd($validated);
        $this->user->update($validated);

        $this->dispatch('notify', 'Profile saved!');
    }

    public function render()
    {
        return view('authit::user.update-profile-form');
    }
}
