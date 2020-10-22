@extends('layouts.app')

@section('content')

    <div class="col-md-50 max bx">

        <div class="bx-header">
            <div class="bx-title">Verify Your Email</div>
        </div>

        @if (session('status'))
            <div class="bx success" role="alert">
                A fresh verification link has been sent to your email address.
            </div>
        @endif

        <p>Before proceeding, please check your email for a verification link. If you did not receive the email,</p>

        <form method="POST" action="/email/verification-notification">
            @csrf
            <x-formit-submit label="click here to request another" />
        </form>

    </div>

@endsection
