<div>


    <x-slot name="title">Profile Information</x-slot>

    <p>Update your account's profile information and email address.</p>

    <form wire:submit.prevent="save" class="bx">

        <x-input wire:model.defer="user.name" for="user.name" label="Name" autocomplete="off" req />

        <x-input wire:model.defer="user.email" for="user.email" label="E-mail" req />


        {{-- NK::TD --}}
        {{--
        <div class="flex va-c">
            @if($upload)
                <img class="round wh-40px" src="{{ $upload->temporaryUrl() }}" alt="Profile Photo">
            @else
                <img class="round wh-40px" src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo">
            @endif

            <div class="file btn sm ml">

                <label>
                    <input wire:model="upload" class="hidden" id="file" name="file" type="file">
                    <svg class="icon">
                        <use xlink:href="/svg/naykel-ui-SVG-sprite.svg#download"></use>
                    </svg>
                    <span>Choose a file…</span>
                </label>

            </div>
        </div>
        --}}

        <x-submit text="Save" rowClasses="tar" />

    </form>

</div>
