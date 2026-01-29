<?php

namespace App\Livewire;

use App\Models\Game;
use Livewire\Component;

class OfficialGamesList extends Component
{
    public $name = "";

    public function render()
    {
        $favoriteIds = auth()->user()?->favorite_games->pluck('id') ?? [];

        $favorite = Game::getOfficialGames()
            ->whereIn('id', $favoriteIds)
            ->get();

        $nonFavorite = Game::getOfficialGames()
            ->whereNotIn('id', $favoriteIds)
            ->when($this->name, fn($query) =>
                $query->where('name', 'like', '%' . $this->name . '%')
            )
            ->get();

        return view('livewire.official-games-list', [
            'favorite' => $favorite,
            'non_favorite' => $nonFavorite,
        ]);
    }
}
