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
    public $possible_users_ids;
    public $user;

    public Game $game;
    public $private_objectives;

    public $search_name = "";
    public $search_results;

    public function updatedSearchName() {
        if(mb_strlen($this->search_name) > 0) {
            $this->search_results = 
                User::whereIn("id", $this->possible_users_ids)
                    ->where("name", "like", "%".$this->search_name."%")
                    ->get();
        }
    }

    public function delete(int $id) {
        $objective = Objective::find($id);

        if($objective->game->creator_id == auth()->user()->id || auth()->user()->isAdmin()) {
            $objective->hidden = true;
            $objective->save();
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
    }

    public function mount() {
        if ($this->user == null) {
            $this->user = auth()->user();
        }

        $this->possible_users_ids = $this->game->private_objectives()->with("objectiveable")->get()->pluck("objectiveable")->pluck("user_id");

        $this->private_objectives = $this->get_user_private_objectives();

        $this->search_results = User::findMany($this->possible_users_ids);
    }

    private function get_user_private_objectives() {
        return $this->game->private_objectives()->whereHas('objectiveable', fn($q) => $q->where('user_id', $this->user->id))->get();
    }

    public function render()
    {
        return view('livewire.user-private-objectives-list');
    }
}
