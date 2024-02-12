<div class="my-2">

    <h2>Profile Information</h2>

    <p>Update your account's profile information and email address.</p>

    <form wire:submit.prevent="save" class="bx">
        @if (config('authit.use_single_name_field'))
            <x-gt-input wire:model="name" for="name" label="Name" autocomplete="name" req />
        @else
            <x-gt-input wire:model="firstname" for="firstname" label="firstname" autocomplete="firstname" req />
            <x-gt-input wire:model="lastname" for="lastname" label="lastname" autocomplete="lastname" req />
        @endif

        <x-gt-input wire:model="email" for="email" label="E-mail" req />

        <div class="tar">
            <x-gt-button wire:click.prevent="save" text="save" class="primary" />
        </div>
    </form>

</div>
