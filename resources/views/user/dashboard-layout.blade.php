<x-gotime-app-layout layout="{{ config('naykel.template') }}">

    <div class="row">

        <div class="col-md-25">

            <div class="bx">
                <div class="tac">
                    <img class="wh200 round" src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo">
                </div>
            </div>

            <div class="bx mt-2">

                <x-authit::user-navigation />

            </div>

        </div>

        <div class="col-md-75 pl-2">

            @isset($title)

                <h1 {{ $title->attributes->class([]) }}> {{ $title }} </h1>

            @endisset

            {{ $slot ?? null }}

        </div>

    </div>

</x-gotime-app-layout>
