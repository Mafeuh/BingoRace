<?php

namespace App\Livewire;

use App\Models\Room;
use Livewire\Component;

class RoomEventsHistory extends Component
{
    public $room_id;
    public Room $room;

    public function mount() {
        $this->room = Room::find($this->room_id);
    }

    public function render()
    {
        return view('livewire.room-events-history', [
            'events' => $this->room->events
        ]);
    }
}
