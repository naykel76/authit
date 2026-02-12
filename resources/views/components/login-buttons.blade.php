@props(['stretched' => false])

<div {{ $attributes }} @class(['grid md:cols-2' => $stretched])>
    <a class="btn primary-outline py-0375 px-1.25" href="{{ route('login') }}">Log in</a>

    @if (config('authit.registration_enabled') && Route::has('register'))
        <a class="btn primary py-0375 px-1.25" href="{{ route('register') }}">Register</a>
    @endif
</div>

