<?php

namespace App\Livewire;

use App\Models\Game;
use Livewire\Component;

class GameObjectiveSelection extends Component
{
    public Game $game;
    public $selected_public_objectives = []; 
    public $selected_private_objectives = [];

    public function mount() {
        $this->selected_public_objectives = $this->game->public_objectives;
        $this->selected_private_objectives = $this->game->private_objectives;
    }

    public function render()
    {
        return view('livewire.game-objective-selection');
    }
}
