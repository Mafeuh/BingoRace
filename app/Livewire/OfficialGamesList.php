<?php

namespace App\Livewire;

use App\Models\Game;
use Livewire\Component;

class OfficialGamesList extends Component
{
    public $name = "";
    public $official_games = [];

    public function mount() {
        $this->official_games = Game::getOfficialGames()->get();
    }
    public function updatedName() {
        $this->official_games = Game::getOfficialGames()->where('name', 'like', "%".$this->name."%")->get();
    }
    public function render()
    {
        return view('livewire.official-games-list');
    }
}
