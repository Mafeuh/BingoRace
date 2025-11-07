<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Team;

class ProfileTeamCard extends Component
{
    public Team $team;

    public function render()
    {
        return view('livewire.profile-team-card');
    }

    public function onClicked() {
        $this->dispatch('team_details', [
            'team' => $this->team
        ]);
    }
}
