<x-gotime-app-layout layout="{{ config('naykel.template') }}">

    <x-authit::auth-box>

        <form method="POST" action="{{ route('register') }}">

            @csrf

            <x-gotime-input for="name" type="text" label="Name" autocomplete="name" />
            <x-gotime-input for="email" type="email" label="E-mail Address" autocomplete="email" />
            <x-gotime-input for="password" type="password" label="Password" autocomplete="password" />
            <x-gotime-input for="password_confirmation" type="password" label="Confirm Password" autocomplete="new-password" />

            <div class="frm-row flex ha-r va-c">
                <a class="mr-1" href="{{ route('login') }}">Already registered?</a>
                <x-gotime-submit text="Register" inline=true/>
            </div>

        </form>

    </x-authit::auth-box>

</x-gotime-app-layout>
