<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Game;
use App\Models\User;
use App\Models\Objective;
use App\Models\PrivateObjective;
use App\Models\PublicObjective;

class UserPrivateObjectivesList extends Component
{
    public $selected_objectives;
    
    public $possible_users_ids;
    public $user;

    public Game $game;
    public $private_objectives;

    public $search_name = "";
    public $search_results;

    public function mount() {
        if ($this->user == null) {
            $this->user = auth()->user();
        }

        $this->possible_users_ids = $this->game->private_objectives()->with("objectiveable")->get()->pluck("objectiveable")->pluck("user_id");

        $this->private_objectives = $this->get_user_private_objectives();

        $this->selected_objectives = array_fill_keys($this->private_objectives->pluck("id")->toArray(), false);

        $this->search_results = User::findMany($this->possible_users_ids);
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
        return $this->game->private_objectives()->whereHas('objectiveable', fn($q) => $q->where('user_id', $this->user->id))->get();
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
        $this->selected_objectives = array_fill_keys($this->private_objectives->pluck("id")->toArray(), false);
    }

    public function render()
    {
        return view('livewire.user-private-objectives-list');
    }
}
