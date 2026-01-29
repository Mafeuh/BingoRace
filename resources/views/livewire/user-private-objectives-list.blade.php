<x-main-panel class="p-2 rounded-3xl" x-data="{ selected: [] }" x-on:private-refreshed.window="selected = []">
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
        @if (auth()->check() && $user == auth()->user())
            {{ __('game.show.private_objectives.title.you', ['amount' => sizeof($private_objectives)]) }}
            <span>
                <a href="/games/{{$game->id}}/objective"
                class="bg-blue-500 p-1 rounded-full hover:bg-blue-600 text-sm">
                ➕
                </a>
            </span>
        @else
            @auth
                {{ __('game.show.private_objectives.title.not_you', ['amount' => sizeof($private_objectives), 'name' => $user->name]) }}
            @endauth
        @endif
        
        
    </h2>
    @if(sizeof($private_objectives) > 0)
        <div class="space-y-2">
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-1 max-h-96 overflow-y-auto overflow-x-visible">
                @foreach ($private_objectives as $priv_obj)
                    <x-objective.line :objective="$priv_obj" :can_manage_objectives="true"/>
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
        @auth
            <div class="text-center dark:text-gray-200">
                {{ __('game.show.private_objectives.empty') }}
            </div>
        @else
            <div class="text-center dark:text-gray-200">
                {{ __('game.show.private_objectives.offline') }}
            </div>
            <div class="flex">
                <a href="/login" class="mx-auto hover:scale-110 transition-all duration-100 bg-gradient-to-r from-red-400 to-blue-400 p-0.5 flex rounded-lg">
                    <span class="py-2 px-4 hover:dark:bg-blue-950/80 bg-gray-200/80 dark:text-slate-200 font-bold dark:bg-slate-900/80 rounded-lg">Login</span>
                </a>
            </div>
        @endauth
    @endif
</x-main-panel>