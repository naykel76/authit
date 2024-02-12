<x-authit::layouts.guest pageTitle="Create your account">

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <x-honeypot />

        @if (config('authit.use_single_name_field'))
            <x-gt-input for="name" label="Name" autocomplete="name" />
        @else
            <div class="grid md:cols-2">
                <x-gt-input for="firstname" label="firstname" autocomplete="firstname" />
                <x-gt-input for="lastname" label="lastname" autocomplete="lastname" />
            </div>
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
