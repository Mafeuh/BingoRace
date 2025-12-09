<x-main-panel class="bg-white p-2 rounded-3xl" x-data="{ selected: [] }" x-on:private-refreshed.window="selected = []">
    @admin()
        <div class="text-center">
            <x-form.text-input placeholder="Nom de l'utilisateur" wire:model.live="search_name"/>
            <span wire:click="clear" class="dark:text-gray-200">Reset</span>

            @if($search_results->count() > 0)
                <div class="max-h-24 overflow-scroll p-1 space-y-1">
                    @forelse ($search_results as $res)
                        <div class="p-0.5 text-xs rounded-lg bg-blue-200 dark:bg-blue-950 dark:text-white" x-on:click="selected = []" wire:click="select_user({{ $res->id }})">
                            {{ $res->name }}
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    @endadmin
    <h2 class="text-lg text-center mb-1 dark:text-gray-200">
        @if ($user == auth()->user())
            {{ __('game.show.private_objectives.title.you', ['amount' => sizeof($private_objectives)]) }}
            <span>
                <a href="/games/{{$game->id}}/objective"
                class="bg-blue-500 p-1 rounded-full hover:bg-blue-600 text-sm">
                ➕
                </a>
            </span>
        @else
            {{ __('game.show.private_objectives.title.not_you', ['amount' => sizeof($private_objectives), 'name' => $user->name]) }}
        @endif
        
        
    </h2>
    @if(sizeof($private_objectives) > 0)
        <div class="space-y-2">
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-1 max-h-96 overflow-y-auto overflow-x-visible">
                @foreach ($private_objectives as $priv_obj)
                    <input class="hidden" type="checkbox" id="obj{{ $priv_obj->id }}" wire:model="selected_objectives.{{ $priv_obj->id }}">
                    
                    <label for="obj{{ $priv_obj->id }}"
                        x-on:click="
                            selected.includes({{ $priv_obj->id }})
                                ? selected = selected.filter(id => id !== {{ $priv_obj->id }})
                                : selected.push({{ $priv_obj->id }});
                            " 
                    :class="selected.includes({{ $priv_obj->id }}) ? 'bg-blue-300 dark:bg-blue-900' : 'mx-2 dark:bg-slate-800 bg-gray-100'"
                    class="cursor-pointer dark:text-gray-200 relative p-1 text-center rounded-xl transition-all duration-100 select-none">
                    <div class="flex space-x-2">
                        <span class="grow">
                            {{$priv_obj->description}}
                        </span>
                        <span @class([ "font-bold",
                            "text-blue-500" => $priv_obj->difficulty == 1,
                            "text-green-500" => $priv_obj->difficulty == 2,
                            "text-orange-400" => $priv_obj->difficulty == 3,
                            "text-red-500" => $priv_obj->difficulty == 4
                        ])>{{ $priv_obj->difficulty }}</span>
                        <a class="right-5" href="/objectives/{{$priv_obj->id}}/edit">✏️</a>
                    </div>
                    </label>
                @endforeach
            </div>

            <div class="text-center">
                <button
                    wire:click="update_difficulty" 
                    x-on:click="selected = []; $wire.clearSelection()"
                    x-bind:disabled="selected.length === 0" 
                    class="text-sm p-1 bg-gray-300 rounded disabled:text-gray-500 disabled:cursor-not-allowed">
                    Changer la difficulté de la sélection
                </button>
                <input 
                    x-bind:disabled="selected.length === 0" min="1" max="3"   
                    type="number" class="w-12 p-0 rounded border-gray-300"
                    wire:model.live="new_difficulty">
                    
                <button
                    x-on:click="selected = []; $wire.clearSelection()"
                    x-show="selected.length > 0"
                    class="bg-red-500 text-white p-1 rounded-full hover:bg-red-600 text-sm ml-2"
                    title="Désélectionner tous les objectifs"
                >
                    ❌
                </button>
            </div>

            <div class="text-center">
                @admin()
                    <button 
                        class="bg-blue-500 p-1.5 text-sm rounded-full
                        disabled:bg-blue-200 disabled:text-gray-500
                        dark:disabled:bg-blue-950"
                        wire:click="set_public"
                        x-bind:disabled="selected.length === 0"
                        x-on:click="selected = []; $wire.clearSelection()">
                        Rendre public
                    </button>
                @endadmin
                <button 
                    class="bg-red-500 p-1.5 text-sm rounded-full text-white
                    disabled:bg-red-200 disabled:text-gray-500
                    dark:disabled:bg-red-950"
                    wire:click="delete"
                    x-bind:disabled="selected.length === 0"
                    x-on:click="selected = []; $wire.clearSelection()">
                    Supprimer la sélection 🗑️
                </button>
            </div>
        </div>
    @else
        <div class="text-center dark:text-gray-200">
            {{ __('game.show.private_objectives.empty') }}
        </div>
    @endif
</x-main-panel>