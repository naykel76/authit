<x-gotime-app-layout layout="{{ config('naykel.template') }}" class="py-5-3-2">

    <x-authit::auth-box>

        <p> {{ __('This is a secure area of the application. Please confirm your password before continuing.') }} </p>

        <p>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>

        @if(session('status'))
            <div class="pxy-05 txt-green" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <x-gt-input-password for="password" label="Password" autocomplete="current-password" />
            <x-gt-submit text="Confirm" rowClass="tar" />

        </form>

    </x-authit::auth-box>

</x-gotime-app-layout>
