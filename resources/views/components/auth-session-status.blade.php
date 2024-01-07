@props(['status'])

@if($status)
    <div {{ $attributes->merge(['class' => 'bx success-light flex va-c txt-sm']) }}>
        <svg class="icon fs0 mr-1">
            <use xlink:href="/svg/naykel-ui.svg#info"></use>
        </svg>
        <div>{{ $status }}</div>
    </div>
@endif
