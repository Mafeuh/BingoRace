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
        if(preg_match('/[0-9.,]/' ,$this->max_teams)) {
            $value = floor(floatval($this->max_teams));

            $this->room->max_teams_check = $value;
            $this->room->save();
        }
    }

    public function render()
    {
        return view('livewire.room-settings-setter');
    }
}
