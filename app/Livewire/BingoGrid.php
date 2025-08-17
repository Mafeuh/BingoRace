<?php

namespace App\Livewire;

use App\Events\SquareChecked;
use App\Models\BingoGrid as ModelsBingoGrid;
use App\Models\BingoGridSquare;
use App\Models\CheckedBy;
use App\Models\Room;
use App\Models\Team;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Livewire;

class BingoGrid extends Component
{
    public int $room_id;
    public Room $room;

    public int $player_team_id;
    public ?Team $player_team = null;

    public BingoGridSquare $previewed_square;

    public \App\Models\BingoGrid $grid;

    protected $listeners = [
        '$refresh', 
        'tryCheckEvent' => 'try_check',
        'square-checked' => 'refresh',
    ];

    public function mount() {
        $this->player_team = Team::find($this->player_team_id);
        $this->room = Room::find($this->room_id);
        $this->grid = $this->room->grid;
    }
    public function try_check(int $square_id) {
        if(!in_array($square_id, $this->grid->squares->pluck('id')->toArray())) {
            return;
        }

        if($this->player_team == null) {
            return;
        }

        $cache_hide_time = Carbon::parse($this->room->started_at)->addSeconds(10)->setTimezone('UTC')->timestamp;
        $server_time = now()->timestamp;

        if($cache_hide_time - $server_time > 0) return;

        $square = BingoGridSquare::find($square_id);

        $checked_by = $square->checked_by;

        $can_check = $this->room->max_teams_check ? sizeof($checked_by) < $this->room->max_teams_check : true;

        if(in_array($this->player_team_id, $checked_by->pluck('id')->toArray())) {
            CheckedBy::where('team_id', $this->player_team_id)->where('square_id', $square_id)->first()->delete();
            broadcast(new SquareChecked($this->room_id))->toOthers();
        } else {
            if($can_check) {
                CheckedBy::create([
                    'team_id' => $this->player_team_id,
                    'square_id' => $square_id,
                    'user_id' => auth()->user()->id
                ]);
                broadcast(new SquareChecked($this->room_id))->toOthers();
            }
        }

        $this->dispatch('$refresh');
    }

    public function try_check_previewed() {
        $this->try_check($this->previewed_square->id);
    }

    public function mobile_preview(int $square_id) {
        if(!in_array($square_id, $this->grid->squares->pluck('id')->toArray())) {
            return;
        }

        $this->previewed_square = BingoGridSquare::find($square_id);
        $this->dispatch('$refresh');
    }

    public function refresh() {
        $this->dispatch('$refresh');
    }

    public function render()
    {
        return view('livewire.bingo-grid');
    }
}
