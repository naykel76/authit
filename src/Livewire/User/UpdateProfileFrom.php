<?php

namespace Naykel\Authit\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class UpdateProfileFrom extends Component
{
    use WithFileUploads;

    public User $editing;

    public $upload;

    protected function rules()
    {
        return [
            'editing.name' => 'required|min:6',
            'editing.email' => 'required|string|email|max:255|unique:users,email,' . $this->editing->id,
        ];
    }

    public function mount()
    {
        $this->editing = auth()->user();
    }

    public function updatedUpload() // real time validation
    {
        $this->validate(['upload' => 'nullable|image|max:1000']);
    }

    public function save()
    {
        $this->validate();

        $this->editing->save();

        if ($this->upload) {
            $this->updateUploadedFile($this->upload);
        }

        $this->dispatch('notify', 'Profile saved!');
    }

    /**
     * Add or update uploaded file
     *
     * @param Illuminate\Http\UploadedFile $file
     * @return void
     */
    public function updateUploadedFile(UploadedFile $file)
    {
        tap($this->editing->avatar, function ($previous) use ($file) {

            $this->editing->forceFill([
                'avatar' => $file->store('/', 'avatars')
            ])->save();

            if ($previous) {
                Storage::disk('avatars')->delete($previous);
            }
        });
    }

    public function render()
    {
        return view('authit::user.update-profile-form');;
    }
}
