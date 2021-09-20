@extends('gotime::layouts.' . config('naykel.template'))

@section('content')

{{-- prevent login form being displayed if allow registration is false --}}

<x-authit::auth-layout>

        <form method="POST" action="{{ route('login') }}">

            @csrf

            <x-formit::input for="email" type="email" label="E-mail Address" rowClasses="nm" />
            <x-formit::input for="password" type="password" label="Password" />
            <x-formit-checkbox for="remember" label="Remember Me" rowClasses="mt-05" />

            <div class="frm-row flex ha-r va-c">
                @if(Route::has('password.request'))
                    <a class="mr-05" href="{{ route('password.request') }}">Forgot Your Password?</a>
                @endif

                <x-formit::submit label="Login" rowClasses="nm" />

            </div>

        </form>
    
</x-authit::auth-layout>

@endsection