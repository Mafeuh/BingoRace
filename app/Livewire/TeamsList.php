<?php

namespace App\Livewire;

use App\Models\AuthParticipant;
use App\Models\Room;
use App\Models\Team;
use App\Models\User;
use Livewire\Component;

class TeamsList extends Component
{
    public ?Room $room = null;
    public ?Team $user_team = null;

    protected $listeners = [
        'teamCreated' => '$refresh',
        'teamJoined' => '$refresh',
        'teamLeft' => '$refresh'
    ];
    
    public function mount(Room $room)
    {
        $this->room = $room;
        $this->user_team = $this->user_in_team(auth()->user());
    }

    public function render()
    {
        $this->user_team = $this->user_in_team(auth()->user());
        
        return view('livewire.teams-list', [
            'room' => $this->room,
        ]);
    }

    public function user_in_team(User $user): ?Team
    {
        foreach ($this->room->teams as $team) {
            foreach ($team->participants as $participant) {
                if (
                    $participant->participantable_type === AuthParticipant::class &&
                    optional($participant->participantable->user)->id === $user->id
                ) {
                    return $team;
                }
            }
        }
        return null;
    }

    public function delete_team(int $team_id) {
        $team = Team::find($team_id);

        foreach ($team->participants as $participant) {
            $participant->delete();
        }

        $team->delete();
    }

    public function join_team(int $team_id) {
        $this->user_team = Team::find($team_id);

        $auth = AuthParticipant::create([
            'user_id' => auth()->user()->id
        ]);

        $auth->participant()->create([
            'team_id' => $team_id,
        ]);

        $this->user_team = Team::find($team_id);

        $this->dispatch('teamJoined');
    }

    public function leave_team() {
        foreach($this->room->teams as $team) {
            foreach ($team->participants as $participant) {
                if (
                    $participant->participantable_type === AuthParticipant::class &&
                    optional($participant->participantable->user)->id === auth()->id()
                ) {
                    $participant->participantable->delete();
                    $participant->delete();
                }
            }
        }
        $this->user_team = null;
    }
}
