<?php

namespace App\Livewire;

use App\Models\Room;
use Livewire\Component;

class RoomTimerSetter extends Component
{
    public ?Room $room = null;
    public bool $disabled;
    public $timer_value = "00:00";
    public function render()
    {
        return view('livewire.room-timer-setter');
    }
    public function mount() {
        if($this->room->duration_seconds) {
            $duration = $this->room->duration_seconds;
            $hours = (floor($duration / 3600));
            $minutes = ($duration / 60) % 60;

            $this->timer_value = sprintf('%02d', $hours).":".sprintf('%02d', $minutes);
        }
    }

    public function updatedTimerValue($value) {
        $split = mb_split(':', $value);

        if(sizeof($split) == 2) {
            $new_value = (int)$split[0] * 3600 + (int)$split[1] * 60;
    
            if($new_value == 0) {
                $this->room->duration_seconds = null;
            } else {
                $this->room->duration_seconds = $new_value;
            }
            $this->room->save();
        }
    }
}
