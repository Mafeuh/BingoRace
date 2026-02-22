<x-main-panel class="max-w-5xl rounded mx-auto">
    @vite('resources/js/room_setup.js')

    <div x-data="objectiveManager({
            pool: @entangle('pool_ids'),
            max_easy: {{ $max_easy }},
            max_medium: {{ $max_medium }},
            max_hard: {{ $max_hard }},
            nb_easy: {{ $nb_easy }},
            nb_medium: {{ $nb_medium }},
            nb_hard: {{ $nb_hard }},
            manage_difficulty: @entangle('choose_difficulty_amount')
        })"
         @quotas-updated.window="updateQuotas()"
         class="w-full h-full flex">
        
        <div class="w-2/5 space-y-4 pr-2 overflow-auto">
            <div class="text-center mb-4">
                <button x-bind:disabled="!can_submit" wire:click="submit" class="bg-blue-600 disabled:bg-gray-500 text-white px-8 py-2 rounded-full font-bold">
                    Lancer la partie
                </button>
            </div>

            <h2 class="text-blue-500 font-bold text-center underline">Paramètres</h2>
            
            <div class="p-2 bg-black/10 rounded-lg">
                <table class="w-full text-xs">
                    @foreach ($room->games->sortBy('id') as $game)
                    <tr>
                        <td class="dark:text-slate-300">{{ $game->name }}</td>
                        <td class="text-right">
                            <input type="range" min="10" max="100" 
                                data-game-id="{{ $game->id }}"
                                wire:model.live.debounce.500ms="games_repartition.{{ $game->id }}"
                                class="game-slider"/>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>

            <div class="pt-2">
                <div>
                    <button @click="showSelection = !showSelection" type="button" class="dark:text-slate-200 text-sm mb-4">
                        <span x-text="showSelection ? '➖' : '➕'"></span> Gérer la pool d'objectifs
                    </button>
    
                    <div x-show="showSelection" class="space-y-4">
                        @foreach ($room->games as $game)
                            <div 
                                class="p-2 rounded border" 
                                :class="is_game_valid[{{ $game->id }}] ? 'bg-white/5 border-gray-500' : 'bg-red-500/20 border-red-500'">
                                <div class="flex justify-between items-center text-[10px] mb-2 uppercase text-slate-400">
                                    <span>{{ $game->name }}</span>
                                    <span>Minimum requis : <span x-text="gameQuotas[{{ $game->id }}] || 0"></span></span>
                                </div>
                                <div class="flex flex-col gap-1 max-h-40 overflow-auto">
                                    @foreach($game->public_objectives->merge($game->private_objectives) as $obj)
                                        <button type="button"
                                            data-id="{{ $obj->id }}"
                                            data-game="{{ $game->id }}"
                                            data-difficulty="{{ $obj->difficulty }}"
                                            @click="toggle($el)"
                                            :class="pool[{{ $obj->id }}] ? 'bg-blue-600/20 border-blue-500/50' : 'opacity-40 grayscale border-transparent'"
                                            class="objective-item text-left p-2 rounded border text-xs transition-all hover:bg-blue-500/10">
                                            <div class="flex justify-between items-center">
                                                <span class="dark:text-slate-200">{{ $obj->description }}</span>
                                                <span @class([
                                                    "border-2 rounded font-mono px-2 py-1",
                                                    "border-green-500 bg-green-500/20" => $obj->difficulty == 1,
                                                    "border-yellow-500 bg-yellow-500/20" => $obj->difficulty == 2,
                                                    "border-red-500 bg-red-500/20" => $obj->difficulty == 3
                                                ])>
                                                    {{ $obj->difficulty }}
                                                </span>
                                            </div>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <button @click="showDifficulty = !showDifficulty" type="button" class="dark:text-slate-200 text-sm mb-4">
                        <span x-text="showDifficulty ? '➖' : '➕'"></span> Gérer la répartition de difficulté
                    </button>
    
                    <div x-show="showDifficulty" class="space-y-4">
                        <div :class="difficulty_error ? 'bg-red-500/20' : 'bg-white/5'" class="text-center rounded p-2">
                            <div>
                                <label class="dark:text-slate-200 text-sm" for="activate_difficulty">
                                    Choisir la répartition de difficulté ?
                                </label>
                                <input 
                                    type="checkbox" 
                                    name="activate_difficulty" 
                                    id="activate_difficulty" 
                                    x-model="manage_difficulty"
                                    x-on:change="checkDifficultyValidity">
                            </div>
                            <div class="text-sm" wire:ignore :class="difficulty_error ? 'text-red-500' : 'text-slate-500'">
                                La somme doit valoir <span id="size"></span>
                                (Actuel : <span x-text="nb_easy + nb_medium + nb_hard"></span>)
                            </div>
                            <table class="mx-auto">
                                <tr class="dark:text-slate-200">
                                    <th>Facile</th>
                                    <th>Moyen</th>
                                    <th>Difficile</th>
                                </tr>
                                <tr class="text-xxs dark:text-slate-200">
                                    <td>Max: <span x-text="max_easy"></span></td>
                                    <td>Max: <span x-text="max_medium"></span></td>
                                    <td>Max: <span x-text="max_hard"></span></td>
                                </tr>
                                <tr class="dark:text-slate-200">
                                    <td>
                                        <input 
                                            x-model.number="nb_easy" 
                                            class="w-20 p-1 rounded disabled:text-gray-500 disabled:cursor-not-allowed" 
                                            :class="nb_easy <= max_easy ? 'dark:bg-black/30 border-black' : 'dark:bg-red-500/20 border-red-500'"
                                            type="number" name="easy_amount" id="easy_input"
                                            min="0" :max="max_easy" x-on:change="checkDifficultyValidity"
                                            x-bind:disabled="!manage_difficulty">
                                    </td>
                                    <td>
                                        <input 
                                            x-model.number="nb_medium" 
                                            class="w-20 p-1 rounded disabled:text-gray-500 disabled:cursor-not-allowed" 
                                            :class="nb_medium <= max_medium ? 'dark:bg-black/30 border-black' : 'dark:bg-red-500/20 border-red-500'"
                                            type="number" name="medium_amount" id="medium_input"
                                            min="0" :max="max_medium" x-on:change="checkDifficultyValidity"
                                            x-bind:disabled="!manage_difficulty">
                                    </td>
                                    <td>
                                        <input 
                                            x-model.number="nb_hard" 
                                            class="w-20 p-1 rounded disabled:text-gray-500 disabled:cursor-not-allowed" 
                                            :class="nb_hard <= max_hard ? 'dark:bg-black/30 border-black' : 'dark:bg-red-500/20 border-red-500'"
                                            type="number" name="hard_amount" id="hard_input"
                                            min="0" :max="max_hard" x-on:change="checkDifficultyValidity"
                                            x-bind:disabled="!manage_difficulty">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-0.5 bg-white/10 mx-2"></div>
        
        <div class="w-3/5">
            <h2 class="text-blue-500 font-bold text-center">Aperçu</h2>
            <div class="flex justify-center gap-2 mb-4">
                <input wire:model="width" min="3" max="10" id="width" type="number" class="w-16 bg-white/10 p-1 rounded text-center dark:text-white">
                <span class="text-gray-500">x</span>
                <input wire:model="height" min="3" max="10" id="height" type="number" class="w-16 bg-white/10 p-1 rounded text-center dark:text-white">
            </div>
            <div wire:ignore class="gap-1 w-full grid" id="sample_grid"></div>
        </div>
    </div>

    <template id="square_template">
        <div class="bg-white/10 rounded border border-white/20 aspect-square flex items-center justify-center">
            <span class="text-xl font-bold dark:text-white opacity-40 text"></span>
        </div>
    </template>
</x-main-panel>