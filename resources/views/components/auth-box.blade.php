{{-- auth template layout --}}
<div class="py-5-3-2">


    <div class="maxw600 flex-col mx-auto">

        <div class="mx-auto">
            <img src="{{ config('naykel.logo.path') }}" height="{{ config('naykel.logo.height') }}" alt="{{ config('app.name') }}">
        </div>

        <div class="bx mt">
            {{ $slot }}
        </div>

    </div>

</div>
