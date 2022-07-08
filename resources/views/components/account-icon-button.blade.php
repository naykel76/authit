<div class="dd secondary withState nbdr">
    <div class="icon-button">
        <svg class="icon">
            <use xlink:href="/svg/naykel-ui-SVG-sprite.svg#user"></use>
        </svg>
        <div class="mt-025 lh1">Account</div>
    </div>
    <div class="dd-content bx white pos-r">
        @auth
            <h5 class="mb-1 fw6 nmt">Hello, {{ Auth::user()->name }}</h5>
            <x-authit::user-navigation />
        @else
            <x-authit::login-register-buttons />
        @endauth
    </div>
</div>
