<x-gotime-app-layout layout="{{ config('naykel.template') }}" class="py-5-3-2">

    <x-authit::auth-box>

        @if(session('status') == 'verification-link-sent')
            <div class="bx success-light pxy-1">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="bx-title">Verification Required</div>

        <p>Thanks for registering! Before getting started, please check your email for a verification link. If you didn't receive the email, we will gladly send you another.</p>

        <p>The verification link is valid for 48 hours then re-registration will be required.</p>

        <form method="POST" action="/email/verification-notification">
            @csrf
            <x-submit text="Resend Verification Email" />
        </form>

        <p class="txt-red">If you do not see the email in your inbox, please check your junk mail folder.</p>

    </x-authit::auth-box>

</x-gotime-app-layout>
