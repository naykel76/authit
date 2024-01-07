<x-authit::layouts.guest pageTitle="Verify Password">

    <p class="txt-sm"> {{ __('This is a secure area of the application. Please confirm your password before continuing.') }} </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <x-gt-input.password for="password" label="Password" autocomplete="current-password" />
        <div class="frm-row">
            <x-gt-submit text="Confirm" class="primary" />
        </div>
    </form>

</x-authit::layouts.guest>
