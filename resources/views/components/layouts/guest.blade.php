{{--
README! The guest layout is not completely necessary. It just uses the default
app layout but it is here as a convenience to make changes to the auth
layouts. There should be no need to customize which is why it is not publishable
--}}

<x-gotime-app-layout layout="{{ config('naykel.template') }}" :$pageTitle class="container-sm py-5-3-2-2">

    <div class="bx w-full maxw-lg mx-auto md:pxy-3">
        <h3 class="tac">{{ $pageTitle }}</h3>
        {{ $slot }}
    </div>

    @isset($bottom)
        {{ $bottom }}
    @endisset

</x-gotime-app-layout>
