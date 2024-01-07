<x-authit::layouts.guest pageTitle="Reset password">
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <x-gt-input.email for="email" label="E-mail Address" autocomplete="email" />
        <x-gt-input.password for="password" label="Password" autocomplete="password" />
        <x-gt-input.password for="password_confirmation" label="Confirm Password" autocomplete="new-password" />
        <div class="frm-row">
            <x-gt-submit text="Reset Password" class="primary w-full" />
        </div>
    </form>
</x-authit::layouts.guest>
