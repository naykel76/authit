@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'bx success-light flex va-c txt-sm']) }}>
        <x-gt-icon name="information-circle" class="icon fs0 mr-1" />
        <span>{{ $status }}</span>
    </div>
@endif
