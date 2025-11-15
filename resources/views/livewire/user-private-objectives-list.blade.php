<div class="bg-white p-2 rounded-3xl" x-data="{ selected: [] }">
    @admin()
        <div class="text-center">
            <x-form.text-input placeholder="Nom de l'utilisateur" wire:model.live="search_name"/>
            <span wire:click="clear">Reset</span>

            @if($search_results->count() > 0)
                <div class="max-h-24 overflow-scroll p-1 space-y-1">
                    @forelse ($search_results as $res)
                        <div class="p-0.5 text-xs rounded-lg bg-emerald-200" x-on:click="selected = []" wire:click="select_user({{ $res->id }})">
                            {{ $res->name }}
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    @endadmin
    <h2 class="text-lg text-center mb-1">
        @if ($user == auth()->user())
            {{ __('game.show.private_objectives.title.you', ['amount' => sizeof($private_objectives)]) }}
            <span>
                <a href="/games/{{$game->id}}/objective"
                class="bg-green-500 p-1 rounded-full hover:bg-green-600 text-sm">
                ➕
                </a>
            </span>
        @else
            {{ __('game.show.private_objectives.title.not_you', ['amount' => sizeof($private_objectives), 'name' => $user->name]) }}
        @endif
        
        
    </h2>
    @if(sizeof($private_objectives) > 0)
        <div>
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-1 max-h-96 overflow-y-auto overflow-x-visible">
                @foreach ($private_objectives as $priv_obj)
                    <input class="hidden" type="checkbox" id="obj{{ $priv_obj->id }}" wire:model="selected_objectives.{{ $priv_obj->id }}">
                    
                    <label for="obj{{ $priv_obj->id }}"
                        x-on:click="
                            selected.includes({{ $priv_obj->id }})
                                ? selected = selected.filter(id => id !== {{ $priv_obj->id }})
                                : selected.push({{ $priv_obj->id }});
                            " 
                    :class="selected.includes({{ $priv_obj->id }}) ? 'bg-green-300' : 'mx-2 bg-gray-100'"
                    class="cursor-pointer relative p-1 text-center rounded-xl transition-all duration-100 select-none">
                        <a class="absolute right-5" href="/objectives/{{$priv_obj->id}}/edit">✏️</a>
                        <div class="px-14">
                            <span>
                                {{$priv_obj->description}}
                            </span>
                        </div>
                    </label>
                @endforeach
            </div>

            <div class="text-center mt-2">
                @admin()
                    <button 
                        class="bg-green-500 p-1.5 text-sm rounded-full
                        disabled:bg-green-200 disabled:text-gray-500"
                        wire:click="set_public"
                        x-bind:disabled="selected.length === 0">
                        Rendre public
                    </button>
                @endadmin
                <button 
                    class="bg-red-500 p-1.5 text-sm rounded-full text-white
                    disabled:bg-red-200 disabled:text-gray-500"
                    wire:click="delete"
                    x-bind:disabled="selected.length === 0">
                    Supprimer la sélection 🗑️
                </button>
            </div>
        </div>
    @else
        <div class="text-center">
            {{ __('game.show.private_objectives.empty') }}
        </div>
    @endif
</div>