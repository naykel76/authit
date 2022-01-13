<x-gotime-app-layout layout="{{ config('naykel.template') }}">

    <x-authit::auth-box>

        @if(session('status'))
            <div class="bx success" role="alert">
                A fresh verification link has been sent to your email address.
            </div>
        @endif

        <div class="bx-title">Verification Required</div>

        <p>Thanks for registering! Before getting started, please check your email for a verification link. If you didn't receive the email, we will gladly send you another.</p>

        <p>The verification link is valid for 48 hours then re-registration will be required.</p>

        <form method="POST" action="/email/verification-notification">
            @csrf
            <x-gotime-submit text="Resend Verification Email" />
        </form>

    </x-authit::auth-box>

</x-gotime-app-layout>
