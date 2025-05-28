<?php

namespace App\Livewire;

use App\Models\Room;
use App\View\Components\redirect;
use Livewire\Component;

class RedirectToRoom extends Component
{
    public Room $room;

    public function mount(Room $room) {
        $this->room = $room;
    }

    public function has_started() {
        return $this->room->started_at != null;
    }

    public function render()
    {
        return view('livewire.redirect-to-room');
    }

    public function check_start() {
        if($this->has_started()) {
            return redirect('/room/play');
        }
    }
}
