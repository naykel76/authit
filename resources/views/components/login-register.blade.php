@if(Route::has('register'))
    <div class="flex">
        <div class="col np"><a class="btn-secondary outline fullwidth" href="{{ route('login') }}">Login</a></div>
        <div class="col np"><a class="btn-secondary ml-05 fullwidth" href="{{ route('register') }}">{{ __('Register') }}</a></div>
    </div>
@endif