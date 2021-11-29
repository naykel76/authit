<x-gotime-app-layout layout="{{ config('naykel.template') }}">

    <x-authit::auth-box>

        <form method="POST" action="{{ route('login') }}">

            @csrf

            <x-formit::input for="email" type="email" label="E-mail Address" />
            <x-formit::input for="password" type="password" label="Password" />
            <x-formit-checkbox for="remember" label="Remember Me" rowClasses="mt-05" />

            <div class="frm-row flex ha-r va-c">

                @if(Route::has('password.request'))
                    <a class="mr-05" href="{{ route('password.request') }}">Forgot Your Password?</a>
                @endif

                <x-formit::submit text="Login" inline=true />

            </div>

        </form>

    </x-authit::auth-box>

</x-gotime-app-layout>
