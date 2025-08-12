<?php

namespace App\Livewire;

use App\Models\Objective;
use App\Models\Room;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class GamesObjectivesSelection extends Component
{
    public array $pool;
    public Room $room;
    public int $pool_size;
    public int $width = 5;
    public int $height = 5;

    public function updatedWidth()
    {
        $this->dispatch('trigger-distribute');
    }

    public function updatedHeight()
    {
        $this->dispatch('trigger-distribute');
    }


    public function mount($room_id) {
        $this->room = Room::with(['games.public_objectives', 'games.private_objectives'])
            ->findOrFail($room_id);

        $this->pool = $this->room->games
            ->flatMap(function ($game) {
                return $game->public_objectives->concat($game->private_objectives);
            })->mapWithKeys(function($objective) {
                return [ $objective->id => true ];
            })->toArray();
        
        $this->pool_size = count(array_filter($this->pool));
    }
    public function submit() {
        dd($this->pool);
    }
    public function render()
    {
        return view('livewire.games-objectives-selection');
    }
}
