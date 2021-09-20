@extends('gotime::layouts.' . config('naykel.template'))

@section('content')

<div class="container py-3">

    <h1>My Account</h1>

    {{-- user profile --}}
    <div class="row">

        <div class="col-lg-40">
            <h5>Profile Information</h5>
            <p class="mt-05 txt-sm">Update your account's profile information and email address.</p>
        </div>

        <div class="col-lg-60">
            <x-authit::profile.update-profile-form />
        </div>

    </div>

    <hr>

    {{-- avatar --}}
    <div class="row">

        <div class="col-lg-40">
            <h5>Profile Picture</h5>
            <p class="mt-05 txt-sm">Select your account's profile picture.</p>
        </div>

        <div class="col-lg-60">
            <livewire:users.avatar/>
        </div>

    </div>

    <hr>

    {{-- change password --}}
    @if(Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        <div class="row">

            <div class="col-lg-40">
                <h5>Update Password</h5>
                <p class="mt-05 txt-sm">Ensure your account is using a long, random password to stay secure.</p>
            </div>

            <div class="col-lg-60">
                <x-authit::profile.update-password-form />
            </div>

        </div>
    @endif
</div>

@endsection