<x-authit::guest-layout>

    <p>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>

    <x-authit::auth-session-status class="my" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <x-gt-input.email for="email" label="E-mail Address" autocomplete="email" />
        <x-gt-submit text="EMAIL PASSWORD RESET LINK" rowClass="tar" />
    </form>

</x-authit::guest-layout>
