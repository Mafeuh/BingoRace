<div class="bg-white w-2/3 2xl:w-1/2 m-2 p-2">
    <h2 class="text-emerald-700 text-lg">
        {{ __('game.show.description.title') }}
    </h2>
    @if($can_edit)
    <div class="flex">
        <x-form.textbox-input class="w-full" wire:model="description" placeholder="{{ __('game.show.description.title') }}"></x-form.textbox-input>
        <div class="m-1 justify-center align-middle">
            <span class="bg-emerald-300 p-2 rounded cursor-pointer" wire:click="save_changes">
                {{ __('posts.new.confirm') }}
            </span>
            <div class="block text-sm text-center mt-1 text-emerald-900">
                @if ($message)
                    <span id="message">
                        {{ $message }}
                    </span>
                @endif
            </div>
        </div>
    </div>
    @else
        @if ($description)
            {{ $description }}
        @else
        <span class="italic">
            {{ __('game.show.description.empty') }}
        </span>
        @endif
    @endif

</div>    