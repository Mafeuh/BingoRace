<?php

namespace App\Livewire;

use App\Models\Game;
use Livewire\Component;

class PrivateGamesList extends Component
{
    public $name = "";

    public function render()
    {
        $favoriteIds = auth()->user()->favorite_games->pluck('id');

        $favorite = Game::getAuthPrivateGames()
            ->whereIn('id', $favoriteIds);

        $nonFavorite = Game::getAuthPrivateGames()
            ->whereNotIn('id', $favoriteIds)
            ->when($this->name, fn($query) =>
                $query->where('name', 'like', '%' . $this->name . '%')
            );

        return view('livewire.private-games-list', [
            'favorite' => $favorite,
            'non_favorite' => $nonFavorite,
        ]);
    }
}
