<?php

namespace App\Livewire;

use App\Models\AuthParticipant;
use App\Models\Room;
use App\Models\Team;
use App\Models\User;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class TeamCreationForm extends Component
{    
    use WithFileUploads;

    public ?Room $room = null;
    public string $new_team_name = "";
    public string $selected_color = "";
    public ?TemporaryUploadedFile $new_team_image = null;
    public ?Team $user_team = null;

    protected $listeners = [
        'teamCreated' => '$refresh',
        'teamJoined' => '$refresh',
        'teamLeft' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.team-creation-form', [
            'room' => $this->room,
            'user_team' => $this->user_team
        ]);
    }

    public function mount() {
        $this->user_team = $this->user_in_team(auth()->user());
    }

    public function remove_image() {
        $this->new_team_image = null;
    }

    public function new_team($join = false) {
        if($this->selected_color != "") {
            $imageUrl = '';

            if($this->new_team_image != null) {
                $path = $this->new_team_image->store('public/images');
                $imageUrl = str_replace('public', 'storage', $path);
            }

            $new_team = Team::create([
                "name" => $this->new_team_name,
                "color" => $this->selected_color,
                "room_id" => $this->room->id,
                "image_url" => $imageUrl
            ]);

            if($join) {
                $this->leave_team();
                
                $this->user_team = $new_team;
        
                $auth = AuthParticipant::create([
                    'user_id' => auth()->user()->id
                ]);
        
                $auth->participant()->create([
                    'team_id' => $new_team->id,
                ]);

                $this->dispatch('teamJoined');
            }
        }
        $this->dispatch('teamCreated');
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
