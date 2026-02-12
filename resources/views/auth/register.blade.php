<x-authit::layouts.guest pageTitle="Create your account">

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <x-honeypot />

        @if (config('authit.split_name_fields'))
            <div class="grid md:cols-2">
                <x-gt-input for="first_name" label="First Name" autocomplete="First Name" />
                <x-gt-input for="last_name" label="Last Name" autocomplete="Last Name" />
            </div>
        @else
            <x-gt-input for="name" label="Name" autocomplete="name" />
        @endif

        <x-gt-input.email for="email" label="E-mail Address" autocomplete="email" />
        <x-gt-input.password for="password" label="Password" autocomplete="password" />
        <x-gt-input.password for="password_confirmation" label="Confirm Password" autocomplete="new-password" />
        <div class="frm-row">
            <x-gt-submit text="Register" class="primary w-full" />
        </div>
    </form>

    <x-slot name="bottom">
        <div class="txt-sm tac space-y-1">
            <p>Already have an account?</p>
            <a class="mr-1" href="{{ route('login') }}">Sign in</a>
        </div>
    </x-slot>

</x-authit::layouts.guest>
