@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'txt-sm txt-green']) }}>
        {{ $status }}
    </div>
@endif
