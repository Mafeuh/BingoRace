<?php

namespace App\Livewire;

use App\Models\Participant;
use App\Models\AuthParticipant;
use App\Models\Room;
use App\Models\Team;
use Livewire\Component;

class ParticipantsList extends Component
{
    public ?int $player_team_id = -1;
    public string $new_team_name = "";
    public string $new_team_color = "";

    public function new_team() {
        $new_team = Team::create([
            "name" => $this->new_team_name,
            "color" => $this->new_team_color,
            "room_id"=> session("last_joined_room_id"),
        ]);
    }

    public function delete_team(int $team_id) {
        $team = Team::find($team_id);

        foreach ($team->participants as $participant) {
            $participant->delete();
        }

        $team->delete();
    }

    public function join_team(int $team_id) {
        $this->player_team_id = $team_id;

        $auth = AuthParticipant::create([
            'user_id' => auth()->user()->id
        ]);

        $auth->participant()->create([
            'team_id' => $team_id,
        ]);
    }

    public function leave_team() {
        $this->player_team_id = -1;
    }

    public function render()
    {
        return view('livewire.participants-list', [
            'room' => Room::find(session('last_joined_room_id')),
        ]);
    }
}
