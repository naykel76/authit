<x-gotime-app-layout layout="{{ config('naykel.template') }}">

    <div class="container">

        <div class="row">

            <div class="col-md-25">

                <div class="tac mb-2">
                    <img class="wh200 round" src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo">
                </div>

                <x-authit::user-navigation />

            </div>

            <div class="col-md-75 pl-2">

                @isset($title)

                    <h1 {{ $title->attributes->class([]) }}> {{ $title }} </h1>

                @endisset

                {{ $slot ?? null }}

            </div>

        </div>

    </div>

</x-gotime-app-layout>
