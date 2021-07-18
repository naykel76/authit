@extends('gotime::layouts.' . config('naykel.template'))

@section('content')

{{-- prevent login form being displayed if allow registration is false --}}

<x-authit::auth-layout>
    @if(! config('naykel.account.register'))

        <div class="tac pxy-3">
            <h2 class="txt-upper txt-red">
                We are not taking registrations at this time
            </h2>
        </div>

    @else
        <form method="POST" action="{{ route('login') }}">

            @csrf

            <x-formit-input for="email" type="email" label="E-mail Address" rowClasses="nm" />
            <x-formit-input for="password" type="password" label="Password" />
            <x-formit-checkbox for="remember" label="Remember Me" rowClasses="mt-05" />

            <div class="frm-row flex ha-r va-c">
                @if(Route::has('password.request'))
                    <a class="mr-05" href="{{ route('password.request') }}">Forgot Your Password?</a>
                @endif

                <x-formit-submit label="Login" rowClasses="nm" />

            </div>

        </form>
    @endif
</x-authit::auth-layout>

@endsection