<?php

namespace App\Livewire;

use App\Events\SquareChecked;
use App\Models\Team;
use Livewire\Attributes\On;
use Livewire\Component;
use \App\Models\BingoGridSquare as BingoGridSquareModel;

class BingoGridSquare extends Component
{
    public BingoGridSquareModel $square;

    #[On('echo:bingo-room,SquareChecked')]
    public function refreshSquare($event) {
        $this->updateSquare($event['squareId']);
    }

    public function updateSquare($squareId) {
        $this->square = \App\Models\BingoGridSquare::find($squareId);
    }

    public function try_check() {
        if(!$this->square->checked_at) {
            $this->square->checked_at = now();

            $team = Team::findMany(
                auth()->user()->participations->pluck('participant.team_id')
            )->where('room_id', $this->square->grid->room_id)->first();
            $this->square->checked_by_team_id = $team->id;
            $this->square->save();

            //SquareChecked::dispatch($this->square->id);

            $this->square = \App\Models\BingoGridSquare::find($this->square->id);
        } else {
            $team = Team::findMany(
                auth()->user()->participations->pluck('participant.team_id')
            )->where('room_id', $this->square->grid->room_id)->first();

            if($this->square->checked_by_team_id == $team->id) {
                $this->square->checked_at = null;
                $this->square->checked_by_team_id = null;
                $this->square->save();
            }
        }
    }

    public function render()
    {
        return view('livewire.bingo-grid-square');
    }
}
