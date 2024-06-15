<?php

namespace App\Livewire;

use App\Models\Team;
use Livewire\Component;

class BingoGridSquare extends Component
{
    public \App\Models\BingoGridSquare $square;

    public function try_check() {
        if(!$this->square->checked_at) {
            $this->square->checked_at = now();

            $team = Team::findMany(
                auth()->user()->participations->pluck('participant.team_id')
            )->where('room_id', $this->square->grid->room_id)->first();

            $this->square->checked_by_team_id = $team->id;

            $this->square->save();
        }
    }

    public function render()
    {
        return view('livewire.bingo-grid-square');
    }
}
