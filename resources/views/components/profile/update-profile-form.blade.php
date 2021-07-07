<form class="bx" method="POST" action="{{ route('user.profile-update') }}">

    @csrf

    @method('PUT')

    {{-- errors are explictly added to form because Fortify UpdateUserPassword usaes a named error
        bag. This is to allow multiple forms on one page @error('fieldName', 'errorBagName') --}}

    {{-- need to pass in details!!! --}}
    

    <x-formit-input for="name" label="Name" rowClasses="nm" autocomplete="current-password" value="{{ Auth::user()->name }}"/>
    @error('name', 'updateProfile')
        <span class="txt-red" role="alert"> {{ $message }} </span>
    @enderror

    <x-formit-input for="email" label="Email" value="{{ Auth::user()->email }}"/>
    @error('email', 'updateProfile')
        <span class="txt-red" role="alert"> {{ $message }} </span>
    @enderror

    <x-formit-submit label="Save" rowClasses="tar" />

</form>


    {{--
        <label @isset($required) {{ "class=req" }} @endisset for="{{ $for }}">{{ $label }}</label>

    <input name="{{ $for }}" {{ $errors->has( $for ) ? "class=bdr-red" : null }} {{ $attributes->merge(['type' => 'text']) }} value="{{ old($for) ? old($for) : ($value) }}" />

    @error($for)
        <span class="txt-red" role="alert"> {{ $message }} </span>
    @enderror --}}
