<x-gotime-app-layout layout="{{ config('naykel.template') }}">

    <x-authit::auth-box>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <x-gotime-input for="email" type="email" label="E-mail Address" autocomplete="email" rowClasses="nm" />
            <x-gotime-input for="password" type="password" label="Password" autocomplete="password" />
            <x-gotime-input for="password_confirmation" type="password" label="Confirm Password" autocomplete="new-password" />
            <x-gotime-submit label="Reset Password" rowClasses="tar" />
        </form>

    </x-authit::auth-box>

</x-gotime-app-layout>
