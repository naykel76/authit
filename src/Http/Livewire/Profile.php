<?php

namespace Naykel\Authit\Http\Livewire;

use App\Models\User;
use Illuminate\Validation\Rule;
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

        // $this->emitSelf('notify-saved');
        $this->dispatchBrowserEvent('notify', 'Profile saved!');
    }

    public function render()
    {
        return view('authit::livewire.profile')
        // places livewire component in the slot of dashboard-layout,
        // which is placed in the slot of the main app layout
        ->layout('authit::user.dashboard-layout');
    }
}


// public function updatedImage()
// {
//     $previousPath = auth()->user()->avatar;

//     $path = $this->image->store('/', 'avatars');

//     auth()->user()->update(['avatar' => $path]);

//     Storage::disk('avatars')->delete($previousPath);

//     $this->dispatchBrowserEvent('updated', ['message' => 'Profile changed successfully!']);
// }
