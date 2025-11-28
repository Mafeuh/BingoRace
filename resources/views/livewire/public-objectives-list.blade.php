<div class="bg-white p-2 rounded-3xl" x-data="{ selected: [] }" x-on:public-refreshed.window="selected = []">
    <h2 class="text-xl text-center mb-1">
        {{ __('game.show.public_objectives.title', ['amount' => sizeof($public_objectives)]) }}
        @if ($can_manage_public_objectives)
            <span>
                <a href="/games/{{$game->id}}/objective"
                    class="bg-green-500 p-1 rounded-full hover:bg-green-600 text-sm">➕</a>
            </span>
        @endif
    </h2>
    @if(sizeof($public_objectives) > 0)
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-1 max-h-96 overflow-y-auto overflow-x-visible">
            @foreach ($public_objectives as $pub_obj)
                @admin()
                    <input class="hidden" type="checkbox" id="obj{{ $pub_obj->id }}" wire:model="selected_objectives.{{ $pub_obj->id }}">
                @endadmin
                <label  
                    @admin()
                    for="obj{{ $pub_obj->id }}"
                    x-on:click="
                        selected.includes({{ $pub_obj->id }})
                            ? selected = selected.filter(id => id !== {{ $pub_obj->id }})
                            : selected.push({{ $pub_obj->id }});
                        "
                    @endadmin
                :class="selected.includes({{ $pub_obj->id }}) ? 'bg-green-300' : 'mx-2 bg-gray-100'"
                class="relative bg-gray-100 p-1 text-center rounded-xl cursor-pointer transition-all duration-100 select-none">
                    @admin()
                        <a class="absolute right-5" href="/objectives/{{$pub_obj->id}}/edit">✏️</a>
                    @endadmin
                    <div @class(['pr-14' => $can_manage_public_objectives])>
                        <span>
                            {{$pub_obj->description}}
                        </span>
                    </div>
                </label>
            @endforeach
        </div>

        @admin()
        <div class="text-center mt-2">
            <button 
                class="bg-green-500 p-1.5 text-sm rounded-full
                disabled:bg-green-200 disabled:text-gray-500"
                wire:click="set_private"
                x-bind:disabled="selected.length === 0">
                Rendre privé
            </button>
            <button 
            class="bg-red-500 p-1.5 text-sm rounded-full text-white
            disabled:bg-red-200 disabled:text-gray-500"
            wire:click="delete"
            x-bind:disabled="selected.length === 0">
                Supprimer la sélection 🗑️
            </button>
        </div>
        @endadmin
    @else
        <div class="text-center">
            {{ __('game.show.public_objectives.empty') }}
        </div>
    @endif

</div>