<?php

namespace Naykel\Authit\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public User $user;
    public $upload;

    protected function rules()
    {

        return [
            'user.name' => 'required|min:6',
            'user.email' => 'required|string|email|max:255|unique:users,email,' . $this->user->id,
            'upload' => 'nullable|image|max:1000',
        ];
    }

    public function updateForm()
    {
        $validatedData = $this->validate();

        $this->user->update($validatedData);

        session()->flash('message', 'User successfully updated.');
    }

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function save()
    {
        $this->validate();

        $this->user->save();

        $this->upload && $this->user->update([
            'avatar' => $this->upload->store('/', 'avatars'),
        ]);

        $this->dispatchBrowserEvent('notify', 'Profile saved!');
    }

    public function render()
    {
        return view('authit::livewire.profile')
            ->layout('authit::user.dashboard');
    }
}
