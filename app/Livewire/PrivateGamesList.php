<?php

namespace App\Livewire;

use App\Models\Game;
use Livewire\Component;

class PrivateGamesList extends Component
{
    public $name = "";
    public $private_games = [];

    public function mount() {
        $this->private_games = Game::getAuthPrivateGames()->get();
    }
    public function updatedName() {
        $this->private_games = Game::getAuthPrivateGames()->where('name', 'like', "%".$this->name."%")->get();
    }
    public function render()
    {
        return view('livewire.private-games-list');
    }
}
