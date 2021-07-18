@extends('gotime::layouts.' . config('naykel.template'))

@section('content')

<x-authit::auth-layout>

    <p>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>

    @if(session('status'))
        <div class="pxy-05 success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <x-formit-input for="email" type="email" label="E-mail Address" autocomplete="email" />
        <x-formit-submit label="EMAIL PASSWORD RESET LINK" rowClasses="tar" />
    </form>

</x-authit::auth-layout>

@endsection