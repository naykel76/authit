<div>

    <h1>Update Password</h1>

    <p>Ensure your account is using a long, random password to stay secure.</p>

    <form wire:submit.prevent="updatePassword" class="bx">

        <x-formit::input wire:model.defer="state.current_password" for="current_password" label="Current Password" type="password" />
        <x-formit::input wire:model.defer="state.password" for="password" label="New Password" type="password" />
        <x-formit::input wire:model.defer="state.password_confirmation" for="password_confirmation" label="Current Password" type="password" />

        <x-formit::submit text="Save" />

    </form>

</div>
