<div class="dd secondary withState bdr-0">

    <div class="icon-button">
        <x-gt-icon-user class="icon"></x-gt-icon-user>
        <div class="mt-025 lh-1">Account</div>
    </div>


    <div class="dd-content bx white pos-r pxy-0">
        @auth
            <x-authit::user-navigation />
        @else
            <x-authit::login-register-buttons />
        @endauth
    </div>
</div>




