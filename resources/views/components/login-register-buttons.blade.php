{{-- seperate component with login and register buttons so they
can be access from the icon-button or sidebar --}}

<div class="grid cols-2">
    <a class="btn primary sm outline fullwidth" href="{{ route('login') }}">Login</a>
    <a class="btn primary sm fullwidth" href="{{ route('register') }}">{{ __('Register') }}</a>
</div>
