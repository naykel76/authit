@extends('gotime::layouts.' . config('naykel.template'))

@section('content')

<x-authit::auth-layout>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <x-formit::input for="email" type="email" label="E-mail Address" autocomplete="email" rowClasses="nm" />
        <x-formit::input for="password" type="password" label="Password" autocomplete="password" />
        <x-formit::input for="password_confirmation" type="password" label="Confirm Password" autocomplete="new-password" />
        <x-formit::submit label="Reset Password" rowClasses="tar" />
    </form>

</x-authit::auth-layout>

@endsection