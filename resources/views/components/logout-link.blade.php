@props(['useIcons' => false])

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
        @if($useIcons)
            <x-gt-icon-exit-o />
        @endif
        <span>{{ __('Log Out') }}</span>
    </a>
</form>
