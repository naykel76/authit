@extends('gotime::layouts.' . config('naykel.template'))

@section('content')

<x-authit::auth-layout>

    @if(session('status'))
        <div class="bx success" role="alert">
            A fresh verification link has been sent to your email address.
        </div>
    @endif

    <p>Before proceeding, please check your email for a verification link. If you did not receive the email,</p>

    <form method="POST" action="/email/verification-notification">
        @csrf
        <x-formit::submit label="click here to request another" />
    </form>

</x-authit::auth-layout>

@endsection