<x-authit::layouts.guest pageTitle="Verify Password">

    @if(session('status') == 'verification-link-sent')
        <div class="bx success-light txt-sm pxy-1">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <p>{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</p>

    <form method="POST" action="/email/verification-notification">
        @csrf
        <x-gt-submit text="Resend Verification Email" class="primary w-full" />
    </form>

    <x-slot name="bottom">
        <div class="txt-sm tac mt-05 txt-red">
            <p>If you do not see the email in your inbox, please check your junk mail folder.</p>
        </div>
    </x-slot>

</x-authit::layouts.guest>
