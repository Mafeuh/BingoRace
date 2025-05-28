<?php

namespace App\Livewire;

use App\Models\Room;
use Livewire\Component;

class TeamScores extends Component
{
    public ?Room $room;
    public function render()
    {
        return view('livewire.team-scores');
    }
}
