<x-authit::layouts.guest pageTitle="Reset password">

    <p>Enter your email address and we will email you a password reset link that will allow you to choose a new one.</p>

    <x-authit::auth-session-status class="my" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <x-gt-input.email for="email" label="Email" autocomplete="email" />
        <div class="frm-row">
            <x-gt-submit text="Email Reset Instructions" class="primary w-full" />
        </div>
    </form>

</x-authit::layouts.guest>
