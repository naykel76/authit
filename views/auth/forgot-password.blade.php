@extends('layouts.app')

@section('content')

    <div class="col-md-50 max bx">

        <div class="bx-header">
            <div class="bx-title">Reset Password</div>
        </div>

        @if (session('status'))
            <div class="bx success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <x-formit-input for="email" type="email" label="E-mail Address" autocomplete="email" />
            <x-formit-submit label="Forgot Your Password?" />
        </form>

    </div>

@endsection
