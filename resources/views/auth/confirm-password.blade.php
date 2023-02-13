{{-- this could be considered for the auth layout, however for simplicity leave it here --}}
<x-authit::guest-layout>

    <p> {{ __('This is a secure area of the application. Please confirm your password before continuing.') }} </p>

    @if(session('status'))
        <div class="pxy-05 txt-green" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <x-gt-input.password for="password" label="Password" autocomplete="current-password" />
        <x-gt-submit text="Confirm" rowClass="tar" />

    </form>

</x-authit::guest-layout>
