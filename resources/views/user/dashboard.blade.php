<x-gotime-app-layout layout="{{ config('naykel.template') }}" class="py-5-3-2">

    <div class="grid cols-25_25_100">

        <div>

            <div class="tac mb-2">
                <img class="wh200 round" src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo">
            </div>

            <x-authit::user-navigation />

        </div>

        <div>

            @isset($title)

                <h1 {{ $title->attributes->class([]) }}> {{ $title }} </h1>

            @endisset

            {{ $slot ?? null }}

        </div>

    </div>

</x-gotime-app-layout>
