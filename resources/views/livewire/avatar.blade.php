<div class="bx">

    <div class="frm-row h100">
        @if($uploadedImage)
            <img src="{{ $uploadedImage->temporaryUrl() }}" alt="Profile Photo">
        @else
            <img src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo">
        @endif
    </div>
    
        <form wire:submit.prevent="save" class="mt">

            <x-formit::input wire:model="uploadedImage" type="file" />

            <x-formit::submit label="Save" rowClasses="tar" />

        </form>

</div>
