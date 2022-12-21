{{-- seperate component with login and register buttons so they
can be access from the icon-button or sidebar --}}

<div class="grid cols-2 pxy-1">
    <a class="btn primary sm outline w-full" href="{{ route('login') }}">Login</a>
    <a class="btn primary sm w-full" href="{{ route('register') }}">{{ __('Register') }}</a>
</div>
