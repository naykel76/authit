<div class="bx">

    @if($saved)
        <div class="flex va-c space-between pxy bdrr success-light">
            Saved
            <div wire:click="$set('saved', false)" class="btn success">X</div>
        </div>
    @endif


    <div class="flex">
        
        @if($upload)
            <img class="round wh64" src="{{ $upload->temporaryUrl() }}" alt="Profile Photo">
        @else
            <img class="round wh64" src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo">
        @endif

        <form wire:submit.prevent="save" class="fg1">

            <input wire:model="upload" class="hidden" id="file" name="file" type="file">

            <label class="btn ml fw4" for="file">Select File</label>

            @error('upload')
                <span class="txt-red">{{ $message }}</span>
            @enderror

            <x-formit::submit label="Save" rowClasses="tar" />

        </form>
    </div>

</div>