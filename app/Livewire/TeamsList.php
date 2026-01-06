<?php

namespace App\Livewire;

use App\Events\TeamDeleted;
use App\Events\TeamJoined;
use App\Events\TeamLeft;
use App\Models\AuthParticipant;
use App\Models\AnonymousParticipant;
use App\Models\Participant;
use App\Models\Room;
use App\Models\Team;
use App\Models\User;
use Livewire\Component;

class TeamsList extends Component
{
    public ?Room $room = null;
    public $user_teams;
    
    protected $listeners = [
        'refreshTeamList' => '$refresh',
    ];
    
    public function mount(Room $room)
    {
        $this->room = $room;
        $this->user_teams = $this->get_user_teams();
    }

    public function render()
    {
        $this->user_teams = $this->get_user_teams();
        
        return view('livewire.teams-list', [
            'room' => $this->room,
        ]);
    }

    public function get_user_teams() {
        if(auth()->check()) {
            $team_ids = auth()->user()->participations->pluck('participant.team_id');
            return $this->room->teams->whereIn('id', $team_ids);
        } else {
            $an = AnonymousParticipant::find(session()->get('ap_i'));
            if($an->participant) {
                return $this->room->teams->whereIn('id', [$an->participant->team_id]);
            } else {
                return collect();
            }
        }
    }

    public function check_if_you(Participant $participant) {
        if($participant->participantable_type == "App\Models\AuthParticipant" && auth()->check()) {
            return $participant->participantable->user->id == auth()->user()->id;
        } elseif($participant->participantable_type == "App\Models\AnonymousParticipant" && !auth()->check()) {
            return $participant->participantable->id == session()->get('ap_i');
        }
        return false;
    }

    public function delete_team(int $team_id) {
        $team = Team::find($team_id);

        foreach ($team->participants as $participant) {
            $participant->delete();
        }

        $team->delete();

        broadcast(new TeamDeleted($this->room->id, $team_id));
    }

    public function join_team(int $team_id) {
        $this->user_teams->push(Team::find($team_id));

        if(auth()->check()) {
            $user_participations = auth()->user()->participations;
            $this_room_participations = $user_participations->where('participant.team.room_id', $this->room->id);

            if(sizeof($this_room_participations) == 0) {
                $auth = AuthParticipant::create([
                    'user_id' => auth()->user()->id
                ]);
        
                $auth->participant()->create([
                    'team_id' => $team_id,
                ]);
            }
        } else {
            $anon = AnonymousParticipant::find(session()->get('ap_i'));

            if($anon->participant) {
                $anon->participant()->delete();
            }

            $anon->participant()->create([
                'team_id' => $team_id,
            ]);
        }

        broadcast(new TeamJoined($this->room->id, $team_id, auth()->user()->id ?? null));
    }

    public function leave_team() {
        if(auth()->check()) {
            foreach ($this->user_teams
                        ->pluck('participants')[0]
                        ->where('participantable_type', "App\Models\AuthParticipant")
                        ->where('participantable.user_id', auth()->user()->id) as $participant) {
                $participant->delete();
            }
        } else {
            foreach ($this->user_teams
                        ->pluck('participants')[0]
                        ->where('participantable_type', "App\Models\AnonymousParticipant")
                        ->where('participantable.id', session()->get('ap_i')) as $participant) {
                $participant->delete();
            }
        }
        
        broadcast(new TeamLeft($this->room->id, auth()->user()->id ?? null));
    }
}
