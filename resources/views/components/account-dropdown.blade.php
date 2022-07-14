<div class="dd cursor-pointer">

    @auth

        <div class="flex va-c">
            <img class="wh-2 round" src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo">

            <div class="ml-075">
                <span>{{ Auth::user()->name }}</span>

                <svg class="icon sm">
                    <use href="/svg/naykel-ui-SVG-sprite.svg#down-caret"></use>
                </svg>
            </div>

        </div>

        <div class="dd-content bx pxy-0">
            <x-authit::user-navigation />
        </div>

    @endauth

</div>
