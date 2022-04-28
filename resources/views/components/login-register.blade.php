@if(Route::has('register'))

    @guest

        <div class="grid cols-2 mxy-0">
            <a class="btn primary outline fullwidth" href="{{ route('login') }}">Login</a>
            <a class="btn primary fullwidth" href="{{ route('register') }}">{{ __('Register') }}</a>
        </div>

    @else

        <div class="dd">

            <svg class="icon ml primary bdrr wh-40px">
                <use xlink:href="/svg/nk_icon-defs.svg#icon-user-circle"></use>
            </svg>

            <div class="dd-content mxy-0" style="right: 0px; width: 300px;">
                <h6 class="mb-sm"> Hello, {{ Auth::user()->name }} </h6>
            </div>

        </div>

    @endguest

@endif
