<x-gotime-app-layout layout="{{ config('naykel.template') }}">

    <x-authit::auth-box>

        <p>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>

        @if(session('status'))
            <div class="pxy-05 success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <x-input-email for="email" label="E-mail Address" autocomplete="email" />
            <x-gotime-submit text="EMAIL PASSWORD RESET LINK" rowClasses="tar" />
        </form>

    </x-authit::auth-box>

</x-gotime-app-layout>
