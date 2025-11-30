<x-secondary_panel :title="__('game.show.description.title')" class="w-2/3 2xl:w-1/2 m-2 rounded">
    @if($can_edit)
    <div class="flex">
        <x-form.textbox-input class="w-full" wire:model="description" placeholder="{{ __('game.show.description.title') }}"></x-form.textbox-input>
        <div class="m-1 justify-center align-middle">
            <span class="bg-blue-300 dark:bg-blue-900 p-2 rounded cursor-pointer" wire:click="save_changes">
                {{ __('posts.new.confirm') }}
            </span>
            <div class="block text-sm text-center mt-1 text-blue-500">
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
</x-secondary_panel>