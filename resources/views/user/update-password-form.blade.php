<div class="my-2">

    <h3>Update Password</h3>

    <p>Ensure your account is using a long, random password to stay secure.</p>

    <form wire:submit="updatePassword" class="bx">
        <x-gt-input.password wire:model="current_password" for="current_password" label="Current Password" req />
        <x-gt-input.password wire:model="password" for="password" label="New Password" req />
        <x-gt-input.password wire:model="password_confirmation" for="password_confirmation" label="Confirm Password" req />

        <div class="tar">
            <button type="submit" class="btn primary">Save</button>
        </div>
    </form>

</div>
