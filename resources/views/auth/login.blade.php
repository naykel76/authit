<x-authit::layouts.guest pageTitle="Sign in to your account">

    <x-authit::auth-session-status class="mb" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <x-gt-input.email for="email" label="Email" />
        <x-gt-input.password for="password" label="Password" />
        <x-gt-checkbox for="remember" label="Remember Me" />
        <div class="frm-row">
            <x-gt-submit text="Login" class="primary w-full" />
        </div>
    </form>

    <x-slot name="bottom">
        <div class="txt-sm tac space-y-1">
            @if(Route::has('password.request'))
                <p>Forgot your <a href="{{ route('password.request') }}">password</a>?</p>
            @endif
            <p>Need and account? <a href="{{ route('register') }}">Sign up here.</a></p>
        </div>
    </x-slot>

</x-authit::layouts.guest>
