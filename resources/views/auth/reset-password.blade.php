<x-authit::layouts.guest title="Reset password">
    <x-slot name="top">
        <x-authit::auth-header :title="__('Reset password')" :description="__('Please enter your new password below')" />
    </x-slot>

    <x-authit::auth-session-status class="mb" :status="session('status')" />

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <x-gt-input.email for="email" label="Email Address"
            required autocomplete="email" />

        <x-gt-input.password for="password" label="Password"
            required autocomplete="new-password" :placeholder="__('Password')" viewable />

        <x-gt-input.password for="password_confirmation" label="Confirm Password"
            required autocomplete="new-password" :placeholder="__('Confirm password')" viewable />

        <div class="frm-row">
            <x-gt-submit text="Reset Password" class="primary w-full" />
        </div>
    </form>
</x-authit::layouts.guest>