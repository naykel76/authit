@props(['useIcons' => false])

    @auth

        {{-- the menu class is to keep styling consistancy when used with user navigation --}}
        <form method="POST" class="menu" action="{{ route('logout') }}">

            @csrf

            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">

                @if($useIcons)
                    <x-gt-icon-exit-o />
                @endif

                <span>{{ __('Log Out') }}</span>
            </a>

        </form>

    @endauth
