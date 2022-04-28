<x-gotime-app-layout layout="{{ config('naykel.template') }}">

    <x-authit::auth-box>

        <form method="POST" action="{{ route('register') }}">

            @csrf
            <x-honeypot />

            <x-input for="name" label="Name" autocomplete="name" />
            <x-input-email for="email" label="E-mail Address" autocomplete="email" />
            <x-input-password for="password" label="Password" autocomplete="password" />
            <x-input-password for="password_confirmation" label="Confirm Password" autocomplete="new-password" />

            <div class="frm-row flex ha-r va-c">
                <a class="mr-1" href="{{ route('login') }}">Already registered?</a>
                <x-gotime-submit text="Register" inline=true />
            </div>

        </form>

    </x-authit::auth-box>

</x-gotime-app-layout>
