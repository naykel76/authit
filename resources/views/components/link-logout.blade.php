@props(['icon' => true])

<form action="{{ route('logout') }}" method="POST">

    @csrf

    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">

        @if($icon)
            <svg class="icon">
                <use xlink:href="/svg/nk_icon-defs.svg#icon-exit"></use>
            </svg>
        @endif

        <span>Logout</span>
    </a>

</form>