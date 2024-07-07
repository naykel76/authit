<x-gt-app-layout layout="{{ config('naykel.template') }}" :$pageTitle class="container py-3">

    <div class="flex gap-2 pxy">

        <div class="w-20 to-md:hidden fs0">
            <div class="tac mb-2">
                <img class="wh-12 rounded-full" src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo">
            </div>
            <x-authit::user-navigation />
        </div>

        <div class="fg1">
            {{ $slot }}
        </div>

    </div>

</x-gt-app-layout>
