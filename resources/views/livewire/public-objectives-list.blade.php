<x-main-panel class="p-2 rounded-3xl space-y-2" x-data="{ selected: [] }" x-on:public-refreshed.window="selected = []">
    <h2 class="text-xl text-center mb-1 dark:text-gray-200">
        {{ __('game.show.public_objectives.title', ['amount' => sizeof($public_objectives)]) }}
        @if ($can_manage_public_objectives)
            <span>
                <a href="/games/{{$game->id}}/objective"
                    class="bg-blue-500 p-1 rounded-full hover:bg-blue-600 text-sm">➕</a>
            </span>
        @endif
    </h2>
    @if(sizeof($public_objectives) > 0)
        <div class="grid gap-1 max-h-96 overflow-y-auto overflow-x-visible">
            @foreach ($public_objectives as $pub_obj)
                <x-objective.line :objective="$pub_obj" :can_manage_objectives="$can_manage_public_objectives"/>
            @endforeach
        </div>

        @if ($can_manage_public_objectives)
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
                    class="bg-red-500/50 text-white p-1 rounded-full hover:bg-red-600 text-sm ml-2"
                    title="Désélectionner tous les objectifs"
                >
                    ❌
                </button>
            </div>
        @endif
    
        @admin()
        <div class="text-center">
            <button 
                class="bg-blue-500 p-1.5 text-sm rounded-full
                disabled:bg-blue-200 disabled:text-gray-500
                dark:disabled:bg-blue-950"
                wire:click="set_private"
                x-on:click="selected = []; $wire.clearSelection()"
                x-bind:disabled="selected.length === 0">
                Rendre privé
            </button>
            <button 
            class="bg-red-500 p-1.5 text-sm rounded-full text-white
            disabled:bg-red-200 disabled:text-gray-500
            dark:disabled:bg-red-950"
            wire:click="delete"
            x-on:click="selected = []; $wire.clearSelection()"
            x-bind:disabled="selected.length === 0">
                Supprimer la sélection 🗑️
            </button>
        </div>
        @endadmin
    @else
        <div class="text-center dark:text-gray-200">
            {{ __('game.show.public_objectives.empty') }}
        </div>
    @endif
</x-main-panel>