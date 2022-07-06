{{-- auth template layout --}}
<div class="py-5-3-2">


    <div class="maxw600 flex-col mx-auto">

        <div class="mx-auto">
            <a href="{{ route('home') }}"><img src="{{ config('naykel.logo.path') }}" height="{{ config('naykel.logo.height') }}" alt="{{ config('app.name') }}"></a>
        </div>

        <div class="bx mt">
            {{ $slot }}
        </div>

    </div>

</div>
