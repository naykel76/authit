<x-authit::guest-layout>

    <x-authit::auth-session-status class="mb" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">

        @csrf

        <x-gt-input.email for="email" label="E-mail Address" />
        <x-gt-input.password for="password" label="Password" />

        <x-gt-checkbox for="remember" label="Remember Me" rowClass="mt-05" />

        <div class="frm-row flex-row ha-r va-c">

            @if(Route::has('password.request'))
                <a class="mr-05" href="{{ route('password.request') }}">Forgot Your Password?</a>
            @endif

            <x-gt-submit text="Login" inline=true />

        </div>

    </form>

</x-authit::guest-layout>
