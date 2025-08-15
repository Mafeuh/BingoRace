<?php

namespace App\Livewire;

use App\Models\Room;
use Livewire\Component;

class RoomSetup extends Component
{
    public Room $room;
    public int $width = 5;
    public int $height = 5;
    public int $min_pool_size = 25;
    public bool $can_start = true;

    public function updatePoolSize() {
        $this->min_pool_size = $this->width * $this->height;
        $this->dispatch('updatedPoolSize');
    }
    public function render()
    {
        return view('livewire.room-setup');
    }

    public function submit() {
        $this->dispatch('validate');
    }
}
