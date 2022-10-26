<div>

    <h1>Update Password</h1>

    <x-gotime-errors />

    <p>Ensure your account is using a long, random password to stay secure.</p>

    <form wire:submit.prevent="updatePassword" class="bx">

        <x-gt-input-password wire:model.defer="editing.current_password" for="editing.current_password" label="Current Password" req />
        <x-gt-input-password wire:model.defer="editing.password" for="editing.password" label="New Password" req />
        <x-gt-input-password wire:model.defer="editing.password_confirmation" for="editing.password_confirmation" label="Confirm Password" req />

        <x-gt-submit text="Save" rowClass="tar" />

    </form>

</div>

