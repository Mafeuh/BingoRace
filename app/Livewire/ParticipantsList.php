<?php

namespace App\Livewire;

use App\Models\Participant;
use App\Models\AuthParticipant;
use App\Models\Room;
use App\Models\Team;
use App\Models\User;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ParticipantsList extends Component
{
    use WithFileUploads;

    public ?Room $room = null;
    public ?int $player_team_id = -1;
    public string $new_team_name = "";
    public string $new_team_color = "";
    public ?TemporaryUploadedFile $new_team_image = null;

    public ?Team $userTeam = null;

    public function mount(Room $room)
    {
        $this->room = $room;
        $this->userTeam = $this->user_in_team(auth()->user());
    }


    public function remove_image() {
        $this->new_team_image = null;
    }

    public function new_team() {
        if($this->new_team_color != "") {
            $imageUrl = '';

            if($this->new_team_image != null) {
                $path = $this->new_team_image->store('public/images');
                $imageUrl = str_replace('public', 'storage', $path);
            }

            $new_team = Team::create([
                "name" => $this->new_team_name,
                "color" => $this->new_team_color,
                "room_id" => $this->room->id,
                "image_url" => $imageUrl
            ]);
        }
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

        $this->userTeam = Team::find($team_id);
    }

    public function leave_team() {
        foreach ($this->userTeam->participants as $participant) {
            if (
                $participant->participantable_type === AuthParticipant::class &&
                optional($participant->participantable->user)->id === auth()->id()
            ) {
                $participant->delete();
            }
        }

        $this->player_team_id = -1;
        $this->userTeam = null;
    }

    public function render()
    {
        return view('livewire.participants-list', [
            'room' => Room::find(session('last_joined_room_id')),
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
}
