<x-authit::layouts.guest title="Log in to your account">
    <x-slot name="top">
        <x-authit::auth-header :title="__('Log in to your account')"
            :description="__('Enter your email and password below to log in')" />
    </x-slot>

    <x-authit::auth-session-status class="mb" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <x-gt-input.email for="email" label="Email Address" required
            autofocus autocomplete="email" placeholder="email@example.com" />

        <x-gt-input.password for="password" label="Password" required
            autocomplete="current-password" placeholder="Password" viewable />

        <x-gt-checkbox for="remember" label="Remember Me" />

        <div class="frm-row">
            <x-gt-submit text="Login" class="primary w-full" />
        </div>
    </form>

    <x-slot name="bottom">
        @if (Route::has('password.request'))
            <p>Forgot your <a href="{{ route('password.request') }}">password</a>?</p>
        @endif
        @if (config('authit.registration_enabled') && Route::has('register'))
            <p class="mt-05">Need an account? <a href="{{ route('register') }}">Sign up here.</a></p>
        @endif
    </x-slot>
</x-authit::layouts.guest>
