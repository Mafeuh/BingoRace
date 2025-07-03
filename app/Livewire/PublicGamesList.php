<?php

namespace App\Livewire;

use App\Models\Game;
use Livewire\Component;

class PublicGamesList extends Component
{
    public $name = "";

    public function render()
    {
        $favoriteIds = auth()->user()->favorite_games->pluck('id');

        $favorite = Game::getPublicGames()
            ->whereIn('id', $favoriteIds)
            ->get();

        $nonFavorite = Game::getPublicGames()
            ->whereNotIn('id', $favoriteIds)
            ->when($this->name, fn($query) =>
                $query->where('name', 'like', '%' . $this->name . '%')
            )
            ->get();

        return view('livewire.public-games-list', [
            'favorite' => $favorite,
            'non_favorite' => $nonFavorite,
        ]);
    }
}
