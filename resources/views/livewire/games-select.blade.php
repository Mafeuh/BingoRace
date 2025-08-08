<form class="h-full bg-white rounded-lg shadow-xl p-5 md:flex" x-data="{ 
    selected: {},
    toggle_game(id, name) {
        if(this.selected[id]) {
            delete this.selected[id];
        } else {
            this.selected[id] = name;
        }
    }
}">
    <div class="bg-gray-100 border-2 rounded-l-lg" wire:key="{{ now() }}">
        <div class="p-2 border-b-2 text-center">
            <h2 class="text-center text-xl">
                {{ __('room.start.game_selection.filters.title') }}
            </h2>
            <x-form.label for="name">
                {{ __('game.creation.form.name.label') }}
            </x-form.label>
            <input id="name" type="text" placeholder=""
               wire:model.live.debounce.500ms="search"
               class="border border-gray-300 rounded-full text-center py-2 px-4 w-full"/>
            
            <x-form.label for="lang">
                {{ __('game.creation.form.language.label') }}
            </x-form.label>
            <select id="lang" wire:model.live.debounce="lang" class="border-1 border-gray-200 rounded-full text-center py-2 w-full">
                @foreach (\App\Models\Game::$available_languages as $lang_slug => $lang_name)
                    <option value="{{ $lang_slug }}" @selected(app()->getLocale() == $lang_slug)>{{ $lang_name }}</option>
                @endforeach
            </select>
            
            <div class="flex justify-center">
                <table>
                    <tr>
                        <td>
                            <input type="checkbox" id="official" wire:model.live.debounce.500ms="show_official_games"/>
                        </td>
                        <td>
                            <label for="official">
                                {{ __('room.start.game_selection.filters.official') }}
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="public" wire:model.live.debounce.500ms="show_public_games"/>
                        </td>
                        <td>
                            <label for="public">
                                {{ __('room.start.game_selection.filters.public') }}
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="private" wire:model.live.debounce.500ms="show_private_games"/>
                        </td>
                        <td>
                            <label for="private">
                                {{ __('room.start.game_selection.filters.private') }}
                            </label>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="p-2">
            <h2 class="text-center text-xl"> 
                {{ __('room.start.game_selection.selected.title', ['amount' => sizeof($selected_games)])}}
            </h2>

            <div>
                <ul>
                    <template x-for="[id, name] in Object.entries(selected)">
                        <li x-text="name"></li>
                    </template>
                </ul>
            </div>
        </div>

        <div class="text-center">
            <button type="button" @class([
                "bg-green-400 text-white p-2 rounded-full",
                "disabled:bg-gray-300 animate-pulse"
            ]) wire:click="start"  {{ !$can_start ? 'disabled' : '' }}>
                Valider !
            </button>
        </div>
    </div>

    <div class="w-full p-5 border-t-2 border-r-2 border-b-2 rounded-r-lg overflow-y-auto max-h-[80vh]">
        <div class="gap-5 grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 2xl:grid-cols-7">
            @forelse ($shown_games as $game)
            <div x-on.click="toggle_game('{{ $game->id }}', '{{ $game->name }}')" class="relative" for="{{ $game->id }}" wire:key="game-card-{{ $game->id }}">
                <label for="{{ $game->id }}">
                    <x-game-card :game="$game" :show_objectives="true" :redirect="false"/>
                    <input 
                        class="absolute top-4 left-4 size-8" 
                        type="checkbox" name="{{ $game->id }}" id="{{ $game->id }}"
                        wire:click="select_game({{ $game->id }})"
                        @checked(in_array($game, $selected_games))/>
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