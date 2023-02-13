<x-authit::guest-layout>

    <form method="POST" action="{{ route('register') }}">

        @csrf
        <x-honeypot />

        <x-gt-input for="name" label="Name" autocomplete="name" />
        <x-gt-input.email for="email" label="E-mail Address" autocomplete="email" />
        <x-gt-input.password for="password" label="Password" autocomplete="password" />
        <x-gt-input.password for="password_confirmation" label="Confirm Password" autocomplete="new-password" />

        <div class="frm-row flex-row va-c ha-r">
            <a class="mr-1" href="{{ route('login') }}">Already registered?</a>
            <button type="submit" class="btn primary">Register</button>
        </div>

    </form>

</x-authit::guest-layout>
