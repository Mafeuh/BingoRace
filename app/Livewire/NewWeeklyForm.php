<?php

namespace App\Livewire;

use App\Models\Game;
use Livewire\Component;

class NewWeeklyForm extends Component
{
    public $search = "";
    public $search_result = [];
    public $selected_games = collect();

    public function updatedSearch() {
        if(strlen($this->search) > 0) {
            $this->search_result = Game::where('name', 'like', '%'.$this->search.'%')->get();
        } else {
            $this->search_result = [];
        }
    }

    public function selectGame(int $game_id)

    public function render()
    {
        return view('livewire.new-weekly-form');
    }
}
