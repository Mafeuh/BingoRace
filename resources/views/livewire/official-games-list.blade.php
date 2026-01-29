<x-main-panel class="text-center rounded dark:text-gray-200">
    <h2 class="text-lg font-bold">
        {{ __('game.list.official_games.title') }}
    </h2>
    <div>
        <i>
            {{ __('game.list.official_games.info') }}
        </i>
    </div>
    <x-form.text-input placeholder="{{ __('game.creation.form.name.label') }}" 
        wire:model.live.debounce.500ms="name"/>
    
    <!-- Zone scrollable -->
    <div class="overflow-y-auto mt-5 flex-1">
        <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-2 2xl:grid-cols-3 gap-1 p-2">
            @foreach($favorite as $game_it)
            <div wire:key="fav-{{$game_it->id}}">
                <x-game-card :game="$game_it"/>
            </div>
            @endforeach
    
            @forelse ($non_favorite as $game_it)
            <div wire:key="nfav-{{$game_it->id}}">
                <x-game-card :game="$game_it"/>
            </div>
            @empty
                <div class="text-center sm:col-span-3 md:col-span-4 ld:col-span-2 2xl:col-span-3">
                    {{ __('game.list.official_games.empty') }}
                </div>
            @endforelse
        </div>
    </div>
</x-main-panel>
