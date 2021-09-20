{{-- user account navigation dropdown --}}

<div class="dd">

    <svg class="icon md wh40 light">
        <use xlink:href="/svg/nk_icon-defs.svg#icon-user-circle"></use>
    </svg>

    <div class="dd-content  pos-r nm">

        <h5 class="mb-1 fw6 nmt">Hello, {{ Auth::user()->name }}</h5>

        <x-gotime-menu menuname="main" filename="nav-user" class="nav">
            <x-authit::link-logout :icon=true />
        </x-gotime-menu>

        {{-- NK::TD create dynamic menus to populate user menues --}}

    </div>

</div>