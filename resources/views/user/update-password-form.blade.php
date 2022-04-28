<div>

    <h1>Update Password</h1>

    <p>Ensure your account is using a long, random password to stay secure.</p>

    <form wire:submit.prevent="updatePassword" class="bx">

        <x-input-password wire:model.defer="state.current_password" for="current_password" label="Current Password" />
        <x-input-password wire:model.defer="state.password" for="password" label="New Password" />
        <x-input-password wire:model.defer="state.password_confirmation" for="password_confirmation" label="Current Password" />

        <x-gotime-submit text="Save" />

    </form>

</div>
