<?php

namespace App\Livewire;

use Livewire\Component;

class ParticipantsList extends Component
{
    public $room;
    public function render()
    {
        return view('livewire.participants-list', [
            'teams' => $this->room->teams
        ]);
    }
}
