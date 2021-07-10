@extends('gotime::layouts.' . config('naykel.template'))

@section('content')

<section>

    <div class="col-lg-40 col-md-80 max bx">

        @if(session('status'))
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
</section>

@endsection
