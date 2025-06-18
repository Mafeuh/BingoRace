<div class="bg-white rounded-3xl p-5 text-center h-[90vh] flex flex-col">
    <h2 class="text-xl font-bold">
        {{ __('game.list.official_games.title') }}
    </h2>
    <div> 
        <i>
            {{ __('game.list.official_games.info') }}
        </i>
    </div>
    <input type="text" placeholder="{{ __('game.creation.form.name.label') }}"
           wire:model.live.debounce.500ms="name"
           class="border border-gray-300 rounded-full text-center py-2 px-4 w-1/2 mx-auto"/>

    <!-- Zone scrollable -->
    <div class="overflow-y-auto mt-5 flex-1">
        <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-2 2xl:grid-cols-3 gap-5">
            @forelse ($official_games as $game_it)
                <a href="/games/{{$game_it->id}}">
                    <x-game-card :game="$game_it"/>
                </a>
            @empty
                <div class="text-center col-span-3">
                    {{ __('game.list.official_games.empty') }}
                </div>
            @endforelse
        </div>
    </div>
</div>
