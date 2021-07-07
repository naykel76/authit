@if(Route::has('register'))
    <div class="">
        <a class="btn-secondary outline" href="{{ route('login') }}">Login</a>
        <a class="btn-secondary ml-05" href="{{ route('register') }}">{{ __('Register') }}</a>
    </div>
@endif