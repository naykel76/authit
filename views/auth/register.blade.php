@extends('layouts.app')

@section('content')

    <div class="col-md-50 max bx">

        <div class="bx-header">
            <div class="bx-title">Register</div>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <x-formit-input for="name" type="text" label="Name" autocomplete="name" />
            <x-formit-input for="email" type="email" label="E-mail Address" autocomplete="email" />
            <x-formit-input for="password" type="password" label="Password" autocomplete="password" />
            <x-formit-input for="password_confirmation" type="password" label="Confirm Password" autocomplete="new-password" />
            <x-formit-submit label="Register"/>
        </form>

    </div>

@endsection
