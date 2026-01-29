<x-main-panel class="max-w-5xl rounded mx-auto">
    @vite('resources/js/sample_grid.js')
    <div class="w-full h-full flex">
        <div class="w-2/5 space-y-2 pr-2">
            <h2 class="text-blue-500 font-bold text-center">
                Paramètres des objectifs
            </h2>
            
            <h3 class="text-blue-500 text-left">
                {{ __('room.setup.objectives_pool.repartition') }}
            </h3>
            <i class="text-slate-600 dark:text-slate-400">Déterminez la proportion des objectifs totaux que prendra chaque jeu. Gardez les sliders équilibrés pour avoir autant d'objectifs par jeu.</i>    
            <div class="p-1 w-fit mx-auto bg-black/10 dark:text-slate-200">
                <table>
                    @foreach ($room->games->sortBy('id') as $game)
                    <tr>
                        <td>
                            {{ $loop->index + 1 }}. {{ $game->name }}
                        </td>
                        <td class="w-2"></td>
                        <td class="text-right">
                            <input type="range" min="10" max="100" id="{{ $game->id }}" wire:model.live.debounce.500ms="games_repartition.{{ $game->id }}"/>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>

            <div class="mx-4 dark:bg-white/5 bg-black/10 p-2" x-data="{ selected_index: 0 }">
                <div class="flex justify-between">
                    <button 
                        class="bg-white/30 px-1 py-0.5 rounded-lg" 
                        x-bind:disabled="selected_index <= 0" x-on:click="selected_index--">
                        <<
                    </button>
                    @foreach ($room->games as $game)
                        <span class="py-0.5 dark:text-slate-300" :class="{ 'hidden': selected_index != {{ $loop->index }} }">
                            {{ $game->name }}
                        </span>
                    @endforeach
                    <button 
                        class="bg-white/30 px-1 py-0.5 rounded-lg" 
                        x-on:click="selected_index++" x-bind:disabled="selected_index >= {{ $room->games->count() }} - 1">
                        >>
                    </button>
                </div>

                @foreach ($room->games as $game)
                    <div class="py-2 space-y-2 text-sm dark:text-slate-900" :class="{ 'hidden': selected_index != {{ $loop->index }} }">
                        @if ($game->public_objectives->count() > 0)
                            <div class="bg-blue-500/30 border-blue-700 border-2 p-0.5 rounded-lg h-24 overflow-auto">
                                @foreach($game->public_objectives as $obj)
                                <label>
                                    <div>
                                        {{ $obj->description }}
                                    </div>
                                </label>    
                                @endforeach
                            </div>
                        @endif
                        @if ($game->private_objectives->count() > 0)
                            <div class="bg-red-500/30 border-red-700 border-2 p-0.5 rounded-lg h-24 overflow-auto">
                                @foreach($game->private_objectives as $obj)
                                    <label>
                                        <div>
                                            {{ $obj->description }}
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <div class="w-0.5 bg-white/30"></div>
        
        <div class="w-3/5">
            <h2 class="text-blue-500 font-bold text-center">
                Aperçu de la grille
            </h2>
            <div class="text-center text-slate-500">
                <i>Les nombres correspondent aux sliders de gauche</i>
            </div>
            <div class="mx-auto w-fit mb-2">
                <div class="flex">
                    <input 
                        wire:model="width" 
                        class="dark:text-slate-200 dark:bg-white/10 p-1 w-16 rounded-l-lg" 
                        type="number" min="3" max="10" id="width" placeholder="Width">
                    <input 
                        wire:model="height" 
                        class="dark:text-slate-200 dark:bg-white/10 p-1 w-16 rounded-r-lg" 
                        type="number" min="3" max="10" id="height" placeholder="Height">
                </div>
            </div>

            <div class="px-24">
                <div wire:ignore class="gap-0.5 w-full grid" style="grid-template-columns: {{ $width }}" id="sample_grid">

                </div>
            </div>
        </div>
    </div>
    <template id="square_template">
        <div class="bg-white/10 rounded border-2 border-white/30" style="aspect-ratio: 1/1">
            <div class="text-center h-full content-center dark:text-gray-200 text-xl text"></div>
        </div>
    </template>
</x-main-panel>
