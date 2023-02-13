@props(['btnClass' => null])

    <div class="dd cursor-pointer {{ $btnClass }}">

        @auth

            <div class="flex va-c py-025">

                @if(method_exists( auth()->user(), 'avatarUrl'))
                    <img class="wh-2 round" src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo">
                @endif

                <div class="ml-075">
                    <span>{{ Auth::user()->name }}</span>
                    <x-gt-icon-down-caret class="ml-025" />
                </div>

            </div>

            <div {{ $attributes->class(['dd-content bx pxy-0 mt-025 block']) }}>

                @if(isset($content))
                    {{ $content }}
                @else
                    @if(auth()->user()->can('access admin'))
                        <x-gt-menu menuname="user" filename="nav-admin" class="menu">
                            <x-authit::logout-link />
                        </x-gt-menu>
                    @else
                        <x-gt-menu menuname="main" filename="nav-user" class="menu">
                            <x-authit::logout-link />
                        </x-gt-menu>
                    @endif
                @endif

            </div>

        @endauth

    </div>
