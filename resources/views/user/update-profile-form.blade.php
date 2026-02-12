<div class="my-2">

    <h2>Profile Information</h2>

    <p>Update your account's profile information and email address.</p>

    <form wire:submit="save" class="bx">
        @if (config('authit.split_name_fields'))
            <x-gt-input wire:model="first_name" for="first_name" label="First Name" autocomplete="First Name" req />
            <x-gt-input wire:model="last_name" for="last_name" label="Last Name" autocomplete="Last Name" req />
        @else
            <x-gt-input wire:model="name" for="name" label="Name" autocomplete="name" req />
        @endif

        <x-gt-input wire:model="email" for="email" label="E-mail" req />

        <div class="tar">
            <x-gt-button wire:click="save" text="save" class="primary" />
        </div>
    </form>

</div>
