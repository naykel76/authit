<div class="dd cursor-pointer">

    @auth

        <div class="flex va-c py-025">

            <img class="wh-2 round" src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo">

            <div class="ml-075">
                <span>{{ Auth::user()->name }}</span>

                <x-gt-icon-down-caret class="icon pxy-05"/>
            </div>

        </div>

        <div class="dd-content bx pxy-0 mt-025">
            <x-authit::user-navigation />
        </div>

    @endauth

</div>
