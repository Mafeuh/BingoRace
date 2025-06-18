<?php

namespace App\Livewire;

use App\Models\Game;
use Livewire\Component;

class PublicGamesList extends Component
{
    public $name = "";
    public $public_games = [];

    public function mount() {
        $this->public_games = Game::where('is_public',  true)->where('is_official', false)->get();
    }
    public function updatedName() {
            $this->public_games = Game::where('is_public',  true)->where('is_official', false)->where('name', 'like', "%".$this->name."%")->get();
    }
    public function render()
    {
        return view('livewire.public-games-list');
    }
}
