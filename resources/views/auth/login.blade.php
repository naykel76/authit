<x-gotime-app-layout layout="{{ config('naykel.template') }}" class="py-5-3-2">

    <x-authit::auth-box>

        <x-authit::auth-session-status class="mb" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">

            @csrf

            <x-input-email for="email" label="E-mail Address" />
            <x-input-password for="password" label="Password" />

            <x-gotime-checkbox for="remember" label="Remember Me" rowClasses="mt-05" />

            <div class="frm-row flex ha-r va-c">

                @if(Route::has('password.request'))
                    <a class="mr-05" href="{{ route('password.request') }}">Forgot Your Password?</a>
                @endif

                <x-submit text="Login" inline=true />

            </div>

        </form>

    </x-authit::auth-box>

</x-gotime-app-layout>
