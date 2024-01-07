{{-- local `auth` layout which is published during the install command --}}
<x-layouts.auth pageTitle="Account Settings">

    <h1>Account Settings</h1>
    <livewire:user.update-profile-form />
    <hr>
    <livewire:user.update-password-form />
</x-layouts.auth>
