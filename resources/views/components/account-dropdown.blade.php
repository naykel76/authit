{{-- user account actions navigation dropdown --}}

<div class="dd">

    <svg class="icon md wh40 light">
        <use xlink:href="/svg/nk_icon-defs.svg#icon-user-circle"></use>
    </svg>

    <div class="dd-content pos-r nm">

        <h5 class="mb-1 fw6 nmt">Hello, {{ Auth::user()->name }}</h5>

        <div class="nav">

            <a href="{{ url('user/dashboard') }}">
                <svg class="icon">
                    <use xlink:href="/svg/nk_icon-defs.svg#icon-dashboard"></use>
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('user.profile-show') }}">
                <svg class="icon">
                    <use xlink:href="/svg/nk_icon-defs.svg#icon-user-circle"></use>
                </svg>
                <span>Profile</span>
            </a>

            <x-authit::link-logout :icon=true />
        </div>

    </div>

</div>