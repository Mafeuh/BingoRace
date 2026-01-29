<form class="rounded-lg shadow-xl md:flex max-w-6xl max-h-[70svh] mx-auto">
    <div class="bg-gray-100/50 dark:bg-white/10 backdrop-blur-sm border-2 p-2 dark:border-black/30 rounded-l-lg flex flex-col" wire:key="{{ now() }}">
        <div class="p-2 text-center">
            <h2 class="text-center text-xl dark:text-gray-200">
                {{ __('room.start.game_selection.filters.title') }}
            </h2>
            <x-form.label for="name">
                {{ __('game.creation.form.name.label') }}
            </x-form.label>
            <x-form.text-input id="name" wire:model.live.debounce.500ms="search"/>
            
            <x-form.label for="lang">
                {{ __('game.creation.form.language.label') }}
            </x-form.label>

            <x-form.select-input id="lang" wire:model.live.debounce="lang">
                @foreach (\App\Models\Game::$available_languages as $lang_slug => $lang_name)
                    <option value="{{ $lang_slug }}" @selected(app()->getLocale() == $lang_slug)>{{ $lang_name }}</option>
                @endforeach
            </x-form.select-input>
            
            <div class="flex justify-center text-left">
                <table>
                    <tr>
                        <td class="pr-2">
                            <input type="checkbox" id="official" wire:model.live.debounce.500ms="show_official_games"/>
                        </td>
                        <td>
                            <label for="official" class="dark:text-gray-200">
                                {{ __('room.start.game_selection.filters.official') }}
                            </label>
                        </td>
                        <td class="pl-2">
                            <x-tooltip_icon :text="__('game.list.official_games.info')"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="public" wire:model.live.debounce.500ms="show_public_games"/>
                        </td>
                        <td>
                            <label for="public" class="dark:text-gray-200">
                                {{ __('room.start.game_selection.filters.public') }}
                            </label>
                        </td>
                        <td class="pl-2">
                            <x-tooltip_icon :text="__('game.list.public_games.info')"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="private" wire:model.live.debounce.500ms="show_private_games"/>
                        </td>
                        <td>
                            <label for="private" class="dark:text-gray-200">
                                {{ __('room.start.game_selection.filters.private') }}
                            </label>
                        </td>
                        <td class="pl-2">
                            <x-tooltip_icon :text="__('game.list.private_games.info')"/>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="h-0.5 bg-black/20 w-full"></div>

        <div class="grow flex flex-col relative">
            <div class="p-2">
                <h2 class="text-center text-xl dark:text-gray-200"> 
                    {{ __('room.start.game_selection.selected.title', ['amount' => sizeof($selected_games_ids)])}}
                </h2>
            
                <div class="absolute w-full left-0 z-10 flex items-center justify-center">
                    <div wire:loading>
                        <svg class="animate-spin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="100" height="100">
                            <circle stroke-dasharray="164.93 56.97" r="35" stroke-width="10" stroke="#aaaaaa" fill="none" cy="50" cx="50"/>
                        </svg>
                    </div>
                </div>
            
                @foreach ($selected_games_ids as $game_id)
                    @php $game = App\Models\Game::find($game_id); @endphp
                    <div class="my-2 static dark:text-gray-200">
                        <span>👾</span>
                        {{ $game->name }}
                    </div>
                @endforeach
            </div>
            
    
            <div class="text-center">
                <x-form.button wire:click="start" :disabled="!$this->can_start">
                    Valider !
                </x-form.button>
            </div>
        </div>
    </div>

    <div class="w-full backdrop-blur-sm p-2 border-t-2 border-r-2 dark:border-black/30 border-b-2 rounded-r-lg overflow-y-auto max-h-fit">
        <div class="gap-1 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
            @forelse ($shown_games as $game)
            <div class="relative" for="{{ $game->id }}" wire:key="game-card-{{ $game->id }}">
                <label for="{{ $game->id }}">
                    <x-game-card :game="$game" :show_objectives="true" :redirect="false"/>
                    <input 
                        class="absolute top-4 left-4 size-8" 
                        type="checkbox" 
                        name="{{ $game->id }}" 
                        id="{{ $game->id }}"
                        wire:click="select_game({{ $game->id }})"
                        @checked(in_array($game->id, $selected_games_ids))
                        wire:loading.attr="disabled"
                    />
                </label>
            </div>
            @empty
                <div>
                    {{ __('room.start.game_selection.no_result') }}
                </div>
            @endforelse
        </div>
    </div>
    
</form>