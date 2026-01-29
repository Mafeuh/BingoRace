<div x-cloak x-data="{ edited: false }">
    @if($can_edit)
        <div>
            <x-form.textbox-input x-on:input="edited = true" class="w-full" wire:model="description" placeholder="{{ __('game.show.description.title') }}"></x-form.textbox-input>
            <button :class="edited ? 'opacity-100 scale-100 block' : 'opacity-0 scale-50 hidden'" class="transition-all duration-200 bg-blue-400 dark:bg-blue-800 p-2 rounded text-white" wire:click="save_changes">
                {{ __('posts.new.confirm') }}
            </button>
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