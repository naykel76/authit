@extends('gotime::layouts.' . config('naykel.template'))

@section('content')


    <form class="col-md-40 max bx" method="POST" action="{{ route('register') }}">
        @csrf
        <x-formit-input for="name" type="text" label="Name" autocomplete="name" rowClasses="nm"/>
        <x-formit-input for="email" type="email" label="E-mail Address" autocomplete="email" />
        <x-formit-input for="password" type="password" label="Password" autocomplete="password" />
        <x-formit-input for="password_confirmation" type="password" label="Confirm Password" autocomplete="new-password" />
        <div class="frm-row flex ha-r va-c">
            <a class="mr-05" href="{{ route('login') }}">Already registered?</a>
            <x-formit-submit label="Register" rowClasses="nm"/>
        </div>
    </form>

@endsection

