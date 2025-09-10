<?php

namespace App\Livewire;

use App\Models\Game;
use App\Models\Objective;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class NewWeeklyForm extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = "";
    public $selected_games_ids = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];

    public function select_game(int $game_id) {
        if(in_array($game_id, $this->selected_games_ids)) {
            $this->selected_games_ids = array_diff($this->selected_games_ids, [$game_id]);
        } else {
            $this->selected_games_ids[] = $game_id;
        }
    }

    public function select_objective($objective_id) {
        $this->dispatch('select_obj', id: $objective_id);
    }

    public function render()
    {
        $search_result = Game::where('name', 'like', '%'.$this->search.'%')->orderBy('name');
        
        return view('livewire.new-weekly-form', [
            'search_result' => Game::fromSub($search_result, 'games')->simplePaginate(8),
            'selected_games' => Game::with(['public_objectives', 'private_objectives'])
                                    ->findMany($this->selected_games_ids)
                                    ->sortBy(fn($game) => strtolower($game->name))
        ]);
    }
}
