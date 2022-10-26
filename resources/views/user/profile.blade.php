<div>

    <x-slot name="title">Profile Information</x-slot>

    <p>Update your account's profile information and email address.</p>

    <form wire:submit.prevent="save" class="bx">

        <x-gt-input wire:model.defer="editing.name" for="editing.name" label="Name" autocomplete="off" req />

        <x-gt-input wire:model.defer="editing.email" for="editing.email" label="E-mail" req />

        <hr>

        <div class="bx-title">Profile Picture</div>

        <div class="flex va-c">

            @if($upload)
                <img class="round wh-40px" src="{{ $upload->temporaryUrl() }}" alt="Profile Photo">
            @else
                <img class="round wh-40px" src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo">
            @endif

            <div class="ml">
                <x-gt-control.file wire:model.defer="upload" for="upload" />
            </div>

        </div>

        <hr>

        <x-submit text="Save" rowClass="tar" />

    </form>

</div>
