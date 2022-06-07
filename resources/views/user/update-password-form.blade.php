<div>

    <h1>Update Password</h1>

    <p>Ensure your account is using a long, random password to stay secure.</p>

    <form wire:submit.prevent="updatePassword" class="bx">

        <x-input-password wire:model.defer="state.current_password" for="current_password" label="Current Password" />
        <x-input-password wire:model.defer="state.password" for="password" label="New Password" />
        <x-input-password wire:model.defer="state.password_confirmation" for="password_confirmation" label="Current Password" />

        <x-submit text="Save" />

    </form>

</div>



{{-- <div class="container py-4">

    <div class="grid cols-40:60">

        <div>
            <div class="bx-title">Profile Information</div>
            <p>Update your account's profile information and email address.</p>
        </div>

        <form>
            <div class="bx">
                <x-input wire:model.defer="user.name" for="user.name" label="Name" autocomplete="off" />
                <x-input wire:model.defer="user.email" for="user.email" label="E-mail" />
                <div class="tar">
                    <button type="submit" class="btn primary">Save</button>
                </div>
            </div>
        </form>

    </div>

</div> --}}
