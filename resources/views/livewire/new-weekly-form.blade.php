<div class="bg-white/90 w-full rounded-3xl p-2">
    <h1 class="text-center text-xl text-emerald-600 font-bold">
        Création d'une nouvelle grille hebdomadaire
    </h1>

    <div class="grid grid-cols-3 gap-x-2">
        <div class="bg-emerald-50 p-2 space-y-4">
            <h2 class="text-center text-emerald-600 text-lg font-bold">Sélection des jeux</h2>
            
            <div class="text-center">
                <x-form.text-input wire:model.live.debounce.100ms="search" placeholder="Nom du jeu"></x-form.text-input>
            </div>

            <div class="overflow-auto grid grid-cols-4 gap-1.5 p-2">
                @if (sizeof($search_result) > 0)
                    @foreach ($search_result as $game)
                        <div wire:key="game_card_{{$game->id}}" wire:click="select_game({{$game->id}})">
                            <x-game-card :game="$game" :redirect="false" wire:click="select_game({{$game->id}})"/>
                        </div>
                    @endforeach
                @elseif (strlen($this->search) > 0)
                    <div class="text-red-500 col-span-4 text-center">
                        La recherche n'a pas donné de résultat.
                    </div>
                @endif
            </div>

            <div>
                {{ $search_result->links() }}
            </div>
        </div>
        <div class="bg-emerald-50 p-2 space-y-2">
            <h2 class="text-center text-emerald-600 text-lg font-bold">Sélection des objectifs</h2>

            <div class="grid 2xl:grid-cols-2 gap-y-1.5 gap-x-3 h-96 overflow-auto border-emerald-300 border-8 p-0.5 rounded-lg">
                @foreach ($selected_games as $selected_game)
                    <div class="bg-emerald-200 rounded-lg p-1 select-none" wire:key="selected_game_{{$selected_game->id}}">
                        <div class="text-center text-emerald-800 relative">
                            <div class="absolute right-0 text-xs cursor-pointer" wire:click="select_game({{$selected_game->id}})">✖️</div>
                            {{ $selected_game->name }}
                        </div>
                        <div class="bg-emerald-100 h-52 rounded-lg text-xs overflow-auto">
                            <details open>
                                <summary class="bg-emerald-50 text-emerald-800 font-bold text-sm">
                                    {{ __('game.card.public_objectives', ['amount' => sizeof($selected_game->public_objectives)]) }}
                                </summary>
                                <div class="p-1">
                                    @foreach ($selected_game->public_objectives as $pub_obj)
                                        <div class="hover:font-bold cursor-default" wire:click="select_objective({{$pub_obj->id}})">
                                            {{ $pub_obj->description }}
                                        </div>
                                    @endforeach
                                </div>
                            </details>

                            <details open>
                                <summary class="bg-emerald-50 text-emerald-800 font-bold text-sm">
                                    {{ __('game.card.private_objectives', ['amount' => sizeof($selected_game->private_objectives)]) }}
                                </summary>
                                <div class="p-1">
                                    @foreach ($selected_game->private_objectives as $priv_obj)
                                        <div class="hover:font-bold cursor-default" wire:click="select_objective({{$priv_obj->id}})">
                                            {{ $priv_obj->description }}
                                        </div>
                                    @endforeach
                                </div>
                            </details>
                        </div>
                    </div>
                @endforeach
            </div>

            <livewire:weekly-selected-objectives-form/>
        </div>
        <div class="bg-emerald-50 p-2">Règles spécifiques</div>
    </div>
</div>