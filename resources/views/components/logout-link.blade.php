@props(['useIcons' => false])

<form method="POST" action="{{ route('logout') }}" class="my-0">
    @csrf
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
        @if($useIcons)
            <x-gt-icon name="exit" />
        @endif
        <span>{{ __('Log Out') }}</span>
    </a>
</form>
