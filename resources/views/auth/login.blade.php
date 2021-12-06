<x-gotime-app-layout layout="{{ config('naykel.template') }}">

    <x-authit::auth-box>

        <form method="POST" action="{{ route('login') }}">

            @csrf

            <x-gotime-input for="email" type="email" label="E-mail Address" />
            <x-gotime-input for="password" type="password" label="Password" />
            <x-gotime-checkbox for="remember" label="Remember Me" rowClasses="mt-05" />

            <div class="frm-row flex ha-r va-c">

                @if(Route::has('password.request'))
                    <a class="mr-05" href="{{ route('password.request') }}">Forgot Your Password?</a>
                @endif

                <x-gotime-submit text="Login" inline=true />

            </div>

        </form>

    </x-authit::auth-box>

</x-gotime-app-layout>
