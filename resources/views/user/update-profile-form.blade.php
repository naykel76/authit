<div class="my-2">

    <h2>Profile Information</h2>

    <p>Update your account's profile information and email address.</p>

    <form wire:submit.prevent="save" class="bx">

        <x-gt-input wire:model.defer="editing.name" for="editing.name" label="Name" autocomplete="off" req inline />

        <x-gt-input wire:model.defer="editing.email" for="editing.email" label="E-mail" req inline />


        <div class="flex va-c">

            @if($upload)
                <img class="round ml-10 wh-40px" src="{{ $upload->temporaryUrl() }}" alt="Profile Photo">
            @else
                <img class="round ml-10 wh-40px" src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo">
            @endif

            <div class="ml">
                <x-gt-input.file wire:model.defer="upload" for="upload" />
            </div>


        </div>

        <div class="bx-footer tar">
            <x-gt-button-save wire:click.prevent="save" />
        </div>

    </form>

</div>
