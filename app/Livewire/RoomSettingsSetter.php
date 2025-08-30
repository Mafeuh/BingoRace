<?php

namespace App\Livewire;

use App\Models\Room;
use Livewire\Component;
use Str;

class RoomSettingsSetter extends Component
{
    public Room $room;
    public $max_teams;
    
    public function updatedMaxTeams() {
        dd($this->max_teams);
    }

    public function render()
    {
        return view('livewire.room-settings-setter');
    }
}
