<x-layouts.app :title="$title ?? null" class="container flex-centered">
    <div class="max-w-400px w-full">
        @isset($top)
            <div {{ $top->attributes->merge(['class' => 'tac']) }}>
                {{ $top }}
            </div>
        @endisset

        {{ $slot }}

        @isset($bottom)
            <div {{ $bottom->attributes->merge(['class' => 'txt-sm tac mt']) }}>
                {{ $bottom }}
            </div>
        @endisset
    </div>
</x-layouts.app>

{{-- <x-layouts.base :title="$title ?? ($title ?? null)" class="container-sm flex-centered">
    @isset($top)
        <div {{ $top->attributes->merge(['class' => 'tac']) }}>
            {{ $top }}
        </div>
    @endisset

    <div class="max-w-400px w-full">
        {{ $slot }}
    </div>

    @isset($bottom)
        <div {{ $bottom->attributes->merge(['class' => 'txt-sm tac mt']) }}>
            {{ $bottom }}
        </div>
    @endisset
</x-layouts.base> --}}
