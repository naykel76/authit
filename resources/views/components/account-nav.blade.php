<div class="nav nm">
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