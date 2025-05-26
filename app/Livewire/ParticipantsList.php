<?php

namespace App\Livewire;

use App\Models\Participant;
use App\Models\AuthParticipant;
use App\Models\Room;
use App\Models\Team;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ParticipantsList extends Component
{
    use WithFileUploads;
    public ?int $player_team_id = -1;
    public string $new_team_name = "";
    public string $new_team_color = "";
    public ?TemporaryUploadedFile $new_team_image = null;

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
                "room_id" => session("last_joined_room_id"),
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
