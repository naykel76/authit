<x-layouts.app :title="$title ?? null">

    <div class="flex gap-2 pxy">

        <div class="w-20 to-md:hidden fs0">
            <x-authit::user-navigation />
        </div>

        <div class="fg1">
            {{ $slot }}
        </div>

    </div>

</x-layouts.app>
