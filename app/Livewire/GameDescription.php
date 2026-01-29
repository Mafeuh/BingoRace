<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Game;

class GameDescription extends Component
{
    public Game $game;

    public $description;

    public bool $can_edit;

    public $message;

    public function save_changes() {
        $this->game->description = $this->description;
        $this->game->save();
    }

    public function mount() {
        $this->description = $this->game->description;

        $this->can_edit = auth()->user()?->isAdmin() || auth()->user()?->id == $this->game->creator_id;
    }

    public function render()
    {
        return view('livewire.game-description');
    }
}
