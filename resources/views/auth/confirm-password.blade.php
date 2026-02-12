<x-authit::layouts.guest title="Verify Password">
    <x-slot name="top">
        <x-authit::auth-header :title="__('Confirm password')"
            :description="__('This is a secure area of the application. Please confirm your password before continuing.')" />
    </x-slot>

    <x-authit::auth-session-status class="mb" :status="session('status')" />

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <x-gt-input.password for="password" label="Password"
            required autocomplete="current-password" :placeholder="__('Password')" viewable />

        <div class="frm-row">
            <x-gt-submit text="Confirm" class="primary" />
        </div>
    </form>
</x-authit::layouts.guest>
