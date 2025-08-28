<?php

namespace App\Livewire;

use App\Models\Game;
use App\Models\Room;
use App\Models\RoomSelectedGame;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class GamesSelect extends Component
{
    static int $MINIMUM_OBJECTIVES = 9;
    
    public $selected_games_ids = [];
    public $show_official_games = true;
    public $show_public_games = true;
    public $show_private_games = true;

    public $search = "";

    public $lang = "";

    public $can_start = false;

    public function queryBuilder()
    {
        $query = Game::query()->where('lang', $this->lang);

        return $query;
    }

    public function mount() {
        $this->lang = app()->getLocale();
    }

    public function start() {
        if(sizeof($this->selected_games) == 0) {
            session()->flash('error', __('room.start.game_selection.error.not_enough_games'));
            return redirect('/room/start');
        }

        $new_room = Room::create([
            'creator_id' => auth()->user()->id
        ]);

        auth()->user()->last_joined_room_id = $new_room->id;
        auth()->user()->save();

        foreach($this->selected_games_ids as $game_id) {
            RoomSelectedGame::create([
                'room_id' => $new_room->id,
                'game_id' => $game_id
            ]);
        }        
        
        return redirect('/room/setup');
    }

    public function select_game(int $game_id) {
        if(in_array($game_id, $this->selected_games_ids)) {
            $this->selected_games_ids = array_diff($this->selected_games_ids, [$game_id]);
        } else {
            $this->selected_games_ids[] = $game_id;
        }

        $this->can_start = 
            Game::whereIn('id', $this->selected_games_ids)
                ->get()
                ->map(fn($g) => count($g->public_objectives ?? []) + count($g->private_objectives ?? []))
                ->sum() >= static::$MINIMUM_OBJECTIVES;

        $this->dispatch('$refresh');
    }

    public function render()
    {
        return view('livewire.games-select', [
                'shown_games' => $this->queryBuilder()->paginate(20),
            ]
        );
    }
}