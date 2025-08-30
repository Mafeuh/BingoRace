<?php

namespace App\Livewire;

use App\Models\BingoGrid;
use App\Models\BingoGridSquare;
use App\Models\Objective;
use App\Models\Room;
use App\View\Components\redirect;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class GamesObjectivesSelection extends Component
{
    public array $pool;
    public $games_objectives_count = [];
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

    public function render()
    {
        return view('livewire.games-objectives-selection');
    }

    #[On('validate')]
    public function selectObjectives() {
        if($this->room->grid) {
            $grid = $this->room->grid;
            $grid->squares->delete();
            $grid->width = $this->width;
            $grid->height = $this->height;
            $grid->save();
        } else {
            $grid = BingoGrid::create([
                'width' => $this->width,
                'height' => $this->height,
                'room_id' => $this->room->id
            ]);
        }

        $objectives = Objective::findMany(array_keys($this->pool, true, true));

        $picked = collect([]);

        foreach($this->games_objectives_count as $game_id => $count) {
            $sub_objectives = $objectives->where('game_id', $game_id);
            
            $picked = $picked->concat($sub_objectives->random($count));
        }

        $picked = $picked->shuffle();

        foreach($picked as $picked_objective) {
            BingoGridSquare::create([
                'grid_id' => $grid->id,
                'objective_id' => $picked_objective->id
            ]);
        }

        return redirect('/room/wait');
    }
}
