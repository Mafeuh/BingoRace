<?php

namespace App\Livewire;

use Livewire\Component;
use \App\Models\Game;
use \App\Models\Objective;
use \App\Models\PublicObjective;
use \App\Models\PrivateObjective;
use Livewire\Attributes\On;

class PublicObjectivesList extends Component
{
    public $selected_objectives = [];

    public $new_difficulty = 1;

    public Game $game;
    public $public_objectives;
    public bool $can_manage_public_objectives;

    #[On('refreshPublic')]
    public function refresh() {
        $this->public_objectives = $this->game->public_objectives;
    }

    public function mount() {
        $this->can_manage_public_objectives = auth()->user()->isAdmin() || auth()->user()->id == $this->game->creator_id;
        $this->refresh();
    }

    public function update_difficulty() {
        foreach(Objective::findMany(array_keys(array_filter($this->selected_objectives))) as $objective) {
            $objective->difficulty = $this->new_difficulty;
            $objective->save();
        }
        $this->refresh();
    }

    public function clearSelection() {
        $this->selected_objectives = [];
    }

    public function render()
    {
        return view('livewire.public-objectives-list');
    }

    public function set_private() {
        $to_change = Objective::findMany(array_keys(array_filter($this->selected_objectives)));

        foreach($to_change as $obj) {
            $priv = PrivateObjective::create([
                'user_id' => $obj->creator_id ?? 1
            ]);
            $obj->objectiveable()->associate($priv);
            $obj->save();
        }

        $this->public_objectives = $this->game->public_objectives;

        $this->dispatch('refreshPrivate');
    }

    public function delete() {
        $objectives = Objective::findMany(array_keys(array_filter($this->selected_objectives)));

        foreach($objectives as $objective) {
            if($objective->game->creator_id == auth()->user()->id || auth()->user()->isAdmin()) {
                $objective->hidden = true;
                $objective->save();
            }
        }

        $this->public_objectives = $this->game->public_objectives;
    }
}
