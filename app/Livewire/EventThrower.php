<?php

namespace App\Livewire;

use App\Events\SquareChecked;
use Livewire\Component;

class EventThrower extends Component
{
    public int $room_id;
    public function throw_event() {
        broadcast(new SquareChecked($this->room_id));
        logger('Broadcast lancé pour room ' . $this->room_id);
    }
    public function render()
    {
        return view('livewire.event-thrower');
    }
}
