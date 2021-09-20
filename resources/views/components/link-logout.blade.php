@props(['icon' => true])

    {{-- link needs to be placed inside nav to style correctly --}}
    <form action="{{ route('logout') }}" method="POST">

        @csrf

        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">

            @if($icon)
                <svg class="icon mr-1">
                    <use xlink:href="/svg/naykel-ui-SVG-sprite.svg#exit"></use>
                </svg>
            @endif

            Logout
        </a>

    </form>