<div class="dd">

    <x-gotime::icon icon="user" class="wh-40px" />

    <div class="dd-content  pos-r mxy-0">

        <h5 class="mb-1 fw6 nmt">Hello, {{ Auth::user()->name }}</h5>

        <x-authit::user-navigation />

    </div>

</div>
