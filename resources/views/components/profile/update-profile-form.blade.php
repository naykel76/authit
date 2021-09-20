<form class="bx" method="POST" action="{{ route('user.update') }}">

    @csrf

    @method('PUT')

    {{-- errors are explictly added to form because Fortify UpdateUserPassword uses a named error
        bag. This is to allow multiple forms on one page @error('fieldName', 'errorBagName') --}}


    <x-formit::input for="name" label="Name" rowClasses="nm" autocomplete="current-password" value="{{ Auth::user()->name }}" />
    @error('name', 'updateProfile')
        <span class="txt-red" role="alert"> {{ $message }} </span>
    @enderror

    <x-formit::input for="email" label="Email" value="{{ Auth::user()->email }}" />
    @error('email', 'updateProfile')
        <span class="txt-red" role="alert"> {{ $message }} </span>
    @enderror

    <x-formit::submit label="Save" rowClasses="tar" />

</form>


