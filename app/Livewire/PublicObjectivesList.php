<?php

namespace App\Livewire;

use Livewire\Component;
use \App\Models\Game;

class PublicObjectivesList extends Component
{
    public Game $game;
    public $public_objectives;
    public bool $can_manage_public_objectives;

    public function mount() {
        $this->public_objectives = $this->game->public_objectives;
        $this->can_manage_public_objectives = auth()->user()->isAdmin() || auth()->user()->id == $this->game->creator_id;
    }

    public function render()
    {
        return view('livewire.public-objectives-list');
    }
}
