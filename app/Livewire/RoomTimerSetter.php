<?php

namespace App\Livewire;

use App\Models\Room;
use Livewire\Component;

class RoomTimerSetter extends Component
{
    public ?Room $room = null;
    public bool $disabled;
    public $timer_value;
    public function render()
    {
        return view('livewire.room-timer-setter');
    }

    public function updatedTimerValue($value) {
        $split = mb_split(':', $value);

        $new_value = (int)$split[0] * 3600 + (int)$split[1] * 60;

        if($new_value == 0) {
            $this->room->duration_seconds = null;
        } else {
            $this->room->duration_seconds = $new_value;
        }
        $this->room->save();
    }
}
