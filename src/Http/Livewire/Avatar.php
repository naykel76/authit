<?php

namespace Naykel\Authit\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Avatar extends Component
{

    use WithFileUploads;
    public User $user;

    public $saved = false;

    public $upload;

    protected $rules = [
        'upload' => 'nullable|image|max:512',
    ];


    public function mount()
    {
        $this->user = auth()->user();
    }


    public function updated($upload)
    {
        $this->validateOnly($upload);
    }


    public function save()
    {

        $this->validate();

        $this->upload && $this->user->update([
            'avatar' => $this->upload->store('/', 'avatars'),
        ]);

        $this->saved = true;
    }

    // public function updated($field)
    // {
    //     // turn of saved message after input update if not manually closed
    //     if ($field !== 'saved') {
    //         $this->saved = false;
    //     }
    // }
    public function render()
    {
        return view('authit::livewire.avatar');
    }
}
