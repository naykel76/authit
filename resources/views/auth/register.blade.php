<x-authit::layouts.guest title="Create an account">
    <x-slot name="top">
        <x-authit::auth-header :title="__('Create an account')"
            :description="__('Enter your details below to create your account')" />
    </x-slot>

    <x-authit::auth-session-status class="mb" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <x-honeypot />

        @if (config('authit.split_name_fields'))
            <div class="grid md:cols-2">
                <x-gt-input for="first_name" label="First Name" autocomplete="First Name"
                    required autofocus autocomplete="first_name" />
                <x-gt-input for="last_name" label="Last Name" autocomplete="Last Name"
                    required autocomplete="last_name" />
            </div>
        @else
            <x-gt-input for="name" label="Name"
                required autofocus autocomplete="name" placeholder="Full name" />
        @endif

        <x-gt-input.email for="email" label="Email Address"
            required autocomplete="new-password" placeholder="email@example.com.au" viewable />

        <x-gt-input.password for="password" label="Password"
            required autocomplete="new-password" placeholder="Password" viewable />

        <x-gt-input.password for="password_confirmation" label="Confirm Password"
            required autocomplete="new-password" placeholder="Confirm Password" viewable />

        <div class="frm-row">
            <x-gt-submit text="Register" class="primary w-full" />
        </div>
    </form>

    <x-slot name="bottom">
        <div class="txt-sm tac space-y-1">
            <span>Already have an account?</span>
            <a wire:navigate href="{{ route('login') }}">Sign in</a>
        </div>
    </x-slot>
</x-authit::layouts.guest>
