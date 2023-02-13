{{-- this could be considered for the auth layout, however for simplicity leave it here --}}
<x-authit::guest-layout>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <x-gt-input.email for="email" label="E-mail Address" autocomplete="email" rowClass="mxy-0" />
        <x-gt-input.password for="password" label="Password" autocomplete="password" />
        <x-gt-input.password for="password_confirmation" label="Confirm Password" autocomplete="new-password" />
        <x-gt-submit text="Reset Password" rowClass="tar" />
    </form>

</x-authit::guest-layout>
