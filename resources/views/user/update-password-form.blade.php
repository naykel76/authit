<div class="my-2">

    <h3>Update Password</h3>

    <p>Ensure your account is using a long, random password to stay secure.</p>

    <form wire:submit.prevent="updatePassword" class="bx">

        <x-gt-input.password wire:model.defer="editing.current_password" for="editing.current_password" label="Current Password" req inline />
        <x-gt-input.password wire:model.defer="editing.password" for="editing.password" label="New Password" req inline />
        <x-gt-input.password wire:model.defer="editing.password_confirmation" for="editing.password_confirmation" label="Confirm Password" req inline />

        <div class="bx-footer tar">
            <button type="submit" class="btn primary">Save</button>
        </div>

    </form>

</div>
