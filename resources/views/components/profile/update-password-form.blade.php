<form class="bx" method="POST" action="{{ route('user-password.update') }}">

    @csrf

    @method('PUT')

    {{-- errors are explictly added to form because Fortify UpdateUserPassword
        usaes a named error bag. This is to allow multiple forms on one page
    @error('fieldName', 'errorBagName') --}}
    

    <x-formit-input for="current_password" label="Current Password" rowClasses="nm" type="password" autocomplete="current-password" />
    @error('current_password', 'updatePassword')
        <span class="txt-red" role="alert"> {{ $message }} </span>
    @enderror

    <x-formit-input for="password" label="New Password" type="password" autocomplete="new-password" />
    @error('password', 'updatePassword')
        <span class="txt-red" role="alert"> {{ $message }} </span>
    @enderror

    <x-formit-input for="password_confirmation" label="Confirm Password" type="password" autocomplete="new-password" />

    <x-formit-submit label="Save" rowClasses="tar" />

</form>
