<?php

namespace App\Livewire;

use App\Models\Game;
use Livewire\Component;

class PublicGamesList extends Component
{
    public $name = "";
    public $public_games = [];

    public function mount() {
        $this->public_games = Game::getPublicGames()->get();
    }
    public function updatedName() {
        $this->public_games = Game::getPublicGames()->where('name', 'like', "%".$this->name."%")->get();
    }
    public function render()
    {
        return view('livewire.public-games-list');
    }
}
