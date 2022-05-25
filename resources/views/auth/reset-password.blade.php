<x-gotime-app-layout layout="{{ config('naykel.template') }}" class="py-5-3-2">

    <x-authit::auth-box>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <x-input-email for="email" label="E-mail Address" autocomplete="email" rowClasses="mxy-0"/>
            <x-input-password for="password" label="Password" autocomplete="password" />
            <x-input-password for="password_confirmation" label="Confirm Password" autocomplete="new-password" />
            <x-submit text="Reset Password" rowClasses="tar" />
        </form>

    </x-authit::auth-box>

</x-gotime-app-layout>
