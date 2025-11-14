<div class="bg-white p-2 rounded-3xl">
    @admin()
        <div class="text-center">
            <x-form.text-input placeholder="Nom de l'utilisateur" wire:model.live="search_name"/>
            <span wire:click="clear">Reset</span>

            @if($search_results->count() > 0)
                <div class="max-h-24 overflow-scroll p-1 space-y-1">
                    @forelse ($search_results as $res)
                        <div class="p-0.5 text-xs rounded-lg bg-emerald-200" wire:click="select_user({{ $res->id }})">
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
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-2">
            @foreach ($private_objectives as $priv_obj)
                <div class="relative bg-gray-100 p-1 text-center rounded-xl">
                    @admin()
                        <button class="absolute left-2">👈</button>
                    @endadmin
                    <button class="absolute right-5" wire:click="delete({{ $priv_obj->id }})">❌</button>
                    <a class="absolute right-10" href="/objectives/{{$priv_obj->id}}/edit">✏️</a>
                    <div class="px-14">
                        <span>
                            {{$priv_obj->description}}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center">
            {{ __('game.show.private_objectives.empty') }}
        </div>
    @endif
</div>