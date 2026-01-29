<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Game;
use App\Models\User;
use App\Models\Objective;
use App\Models\PrivateObjective;
use App\Models\PublicObjective;
use Livewire\Attributes\On;

class UserPrivateObjectivesList extends Component
{
    public $selected_objectives = [];
    
    public $new_difficulty = 1;

    public $possible_users_ids;
    public $user;

    public Game $game;
    public $private_objectives = [];

    public $search_name = "";
    public $search_results;

    #[On('refreshPrivate')]
    public function refresh() {
        $this->private_objectives = $this->get_user_private_objectives();
    }

    public function update_difficulty() {
        if($this->new_difficulty < 1) $this->new_difficulty = 1; 
        if($this->new_difficulty > 3) $this->new_difficulty = 3;
        foreach(Objective::findMany(array_keys(array_filter($this->selected_objectives))) as $objective) {
            $objective->difficulty = $this->new_difficulty;
            $objective->save();
        }
        $this->refresh();
    }
    
    public function mount() {
        if ($this->user == null) {
            $this->user = auth()->user();
        }

        if ($this->user == null) return;

        $this->possible_users_ids = $this->game->private_objectives()->with("objectiveable")->get()->pluck("objectiveable")->pluck("user_id");

        $this->private_objectives = $this->get_user_private_objectives();

        $this->search_results = User::findMany($this->possible_users_ids);
    }

    public function clearSelection() {
        $this->selected_objectives = [];
    }

    public function updatedSearchName() {
        if(mb_strlen($this->search_name) > 0) {
            $this->search_results = 
                User::whereIn("id", $this->possible_users_ids)
                    ->where("name", "like", "%".$this->search_name."%")
                    ->get();
        }
    }

    public function delete() {
        $objectives = Objective::findMany(array_keys(array_filter($this->selected_objectives)));

        foreach($objectives as $objective) {
            if($objective->game->creator_id == auth()->user()->id || auth()->user()->isAdmin()) {
                $objective->hidden = true;
                $objective->save();
            }
        }

        $this->private_objectives = $this->get_user_private_objectives();
    }

    public function clear() {
        $this->user = auth()->user();
        $this->private_objectives = $this->get_user_private_objectives();
    }

    public function select_user(int $user_id) {
        $this->user = User::find($user_id);
        $this->private_objectives = $this->get_user_private_objectives();
        $this->selected_objectives = [];
    }

    private function get_user_private_objectives() {
        return $this->game->private_objectives()->whereRelation('objectiveable', 'user_id', $this->user->id)->get();
    }
    
    public function set_public() {
        if(!auth()->user()->isAdmin()) {
            return;
        }

        $to_public = Objective::with("objectiveable")->findMany(array_keys(array_filter($this->selected_objectives)));

        foreach($to_public as $obj) {
            $pub = PublicObjective::create();
            $obj->objectiveable()->associate($pub);
            $obj->save();
        }

        $this->private_objectives = $this->get_user_private_objectives();
        $this->selected_objectives = [];

        $this->dispatch('refreshPublic');
    }

    public function render()
    {
        return view('livewire.user-private-objectives-list');
    }
}
