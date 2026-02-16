<x-layouts.app :title="$title ?? null" class="container flex-centered py-5-3-2-2">
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
