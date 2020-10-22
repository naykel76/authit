@extends('layouts.app')

@section('content')

    <div class="col-md-50 max bx">

        <div class="bx-header">
            <div class="bx-title">Reset Password</div>
        </div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <x-formit-input for="email" type="email" label="E-mail Address" autocomplete="email" />
            <x-formit-input for="password" type="password" label="Password" autocomplete="password" />
            <x-formit-input for="password_confirmation" type="password" label="Confirm Password" autocomplete="new-password" />
            <x-formit-submit label="Reset Password" />
        </form>

    </div>

@endsection
