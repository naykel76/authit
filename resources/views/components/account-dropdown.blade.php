{{-- user account navigation dropdown --}}

<div class="dd">

    <x:gotime::icon icon="user" class="wh40" />

    <div class="dd-content  pos-r nm">

        <h5 class="mb-1 fw6 nmt">Hello, {{ Auth::user()->name }}</h5>

        <x-gotime-menu menuname="main" filename="nav-user" useIcons=true class="menu" />

    </div>

</div>
