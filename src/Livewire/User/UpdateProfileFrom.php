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
    public string $firstname;
    public string $lastname;
    public string $email;

    // public $upload;

    protected function rules()
    {
        $rules = [
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->user()->id,
        ];

        // If the config option is set to use a single name field then use it,
        // otherwise use firstname and lastname fields.
        if (config('authit.use_single_name_field')) {
            $rules['name'] = ['required', 'string', 'max:255'];
        } else {
            $rules['firstname'] = ['required', 'string', 'max:128'];
            $rules['lastname'] = ['required', 'string', 'max:128'];
        }

        return $rules;
    }


    public function mount()
    {

        $this->user = auth()->user();

        if (config('authit.use_single_name_field')) {
            $this->name = $this->user->name;
        } else {
            $this->firstname = $this->user->firstname;
            $this->lastname = $this->user->lastname;
        }

        // dd($this->user->firstname);
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
        return view('authit::user.update-profile-form');;
    }
}
