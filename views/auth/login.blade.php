@extends('layouts.app')

@section('content')

    <div class="col-md-50 max bx">

        <div class="bx-header">
            <div class="bx-title">Login</div>
        </div>

        <form method="POST" action="{{ route('login') }}">

            @csrf

            <x-formit-input for="email" type="email" label="E-mail Address" />
            <x-formit-input for="password" type="password" label="Password" />
            <x-formit-checkbox for="remember" label="Remember Me"/>

            <div class="frm-row dilf">
                <x-formit-submit label="Login" />

                @if (Route::has('password.request'))
                    <a class="btn ml" href="{{ route('password.request') }}">Forgot Your Password?</a>
                @endif
            </div>

        </form>

    </div>

@endsection
