<div class="bg-white w-full h-full rounded-3xl p-2">
    <h1 class="text-center text-xl text-emerald-600 font-bold">
        Création d'une nouvelle grille hebdomadaire
    </h1>

    <div class="grid grid-cols-3 gap-x-2">
        <div class="bg-gray-200 text-center p-2">
            <h2>Sélection des jeux</h2>
            
            <x-form.text-input wire:model.live.debounce.100ms="search" placeholder="Nom du jeu"></x-form.text-input>

            <div class="overflow-auto">
                @if (sizeof($this->search_result) > 0)
                    @foreach ($this->search_result as $game)
                        <div>{{ $game->name }}</div>
                    @endforeach
                @elseif (strlen($this->search) > 0)
                    <div class="text-red-500">
                        La recherche n'a pas donné de résultat.
                    </div>
                @endif
            </div>
        </div>
        <div class="bg-gray-200 p-2">Sélection des objectifs</div>
        <div class="bg-gray-200 p-2">Règles spécifiques</div>
    </div>
</div>