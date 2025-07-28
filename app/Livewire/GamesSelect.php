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

    public $shown_games = [];
    public $selected_games = [];

    public $show_official_games = true;
    public $show_public_games = true;
    public $show_private_games = true;

    public $search = "";

    public $lang = "";

    public $can_start = false;

    public function updatedLang() {
        $this->queryUpdated();
    }
    public function updatedSearch() {
        $this->queryUpdated();
    }
    public function updatedShowOfficialGames() {
        $this->queryUpdated();
    }
    public function updatedShowPublicGames() {
        $this->queryUpdated();
    }
    public function updatedShowPrivateGames() {
        $this->queryUpdated();
    }

    public function queryUpdated() {
        $games = collect();

        if($this->show_official_games) {
            $games = $games->push(Game::where('is_official', 1)->where('lang', $this->lang)->get());
        }
        if($this->show_public_games) {
            $games = $games->push(Game::where('is_public',  1)->where('is_official', 0)->where('lang', $this->lang)->get());
        }
        if($this->show_private_games) {
            $games = $games->push(Game::where('creator_id', auth()->user()->id)->where('is_public',  0)->where('is_official', 0)->where('lang', $this->lang)->get());
        }

        $games = $games->flatten(1)->unique('id')->values();

        $this->shown_games = $games->filter(function ($game) {
            return str_contains(strtolower($game->name), strtolower($this->search));
        });
    }

    public function mount() {
        $this->lang = app()->getLocale();
        $this->queryUpdated();
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

        foreach($this->selected_games as $game) {
            RoomSelectedGame::create([
                'room_id' => $new_room->id,
                'game_id' => $game->id
            ]);
        }        
        
        return redirect('/room/setup');
    }

    public function select_game(int $game_id) {
        $game = Game::find($game_id);
        
        if(in_array($game, $this->selected_games)) {
            $this->selected_games = array_diff($this->selected_games, array($game));
        } else {
            array_push($this->selected_games, $game);
        }

        $this->can_start = collect(value: $this->selected_games)
            ->map(fn($g) => count($g['public_objectives'] ?? []) + count($g['private_objectives']))
            ->sum() >= static::$MINIMUM_OBJECTIVES;

        $this->dispatch('$refresh');
    }

    public function render()
    {
        return view('livewire.games-select');
    }
}
