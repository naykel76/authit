<div>

    <h1>Update Password</h1>

    <x-gotime-errors />

    <p>Ensure your account is using a long, random password to stay secure.</p>

    <form wire:submit.prevent="updatePassword" class="bx">

        <x-input-password wire:model.defer="editing.current_password" for="editing.current_password" label="Current Password" req />
        <x-input-password wire:model.defer="editing.password" for="editing.password" label="New Password" req />
        <x-input-password wire:model.defer="editing.password_confirmation" for="editing.password_confirmation" label="Current Password" req />

        <x-submit text="Save" rowClasses="tar" />

    </form>

</div>

