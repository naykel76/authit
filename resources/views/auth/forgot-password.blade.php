<x-authit::layouts.guest title="Reset password">
    <x-slot name="top">
        <x-authit::auth-header :title="__('Forgot password')"
            :description="__('Enter your email to receive a password reset link')" />
    </x-slot>

    <x-authit::auth-session-status class="my" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <x-gt-input.email for="email" label="Email" 
            required autofocus placeholder="email@example.com" />

        <div class="frm-row">
            <x-gt-submit text="Email Reset Instructions" class="primary w-full" />
        </div>
    </form>
</x-authit::layouts.guest>



