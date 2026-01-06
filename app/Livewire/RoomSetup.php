<?php

namespace App\Livewire;

use App\Models\Room;
use App\Models\BingoGrid;
use App\Models\Objective;
use App\Models\BingoGridSquare;
use Livewire\Component;

class RoomSetup extends Component
{
    // Number of objectives per game
    public $games_objectives_count = [];

    public Room $room;
    public int $width = 5;
    public int $height = 5;
    public int $min_pool_size = 25;
    public bool $can_start = true;

    public int $pool_size;
    public array $pool_ids;

    public int $max_easy;
    public int $max_medium;
    public int $max_hard;

    public bool $choose_difficulty_amount = false;

    public int $nb_easy = 0;
    public int $nb_medium = 0;
    public int $nb_hard = 0;
    
    public function updatedWidth()
    {
        $this->dispatch('trigger-distribute');
    }

    public function updatedHeight()
    {
        $this->dispatch('trigger-distribute');
    }

    public function updatePoolSize() {
        $this->min_pool_size = $this->width * $this->height;
        $this->dispatch('updatedPoolSize');
    }
    public function render()
    {
        return view('livewire.room-setup');
    }

    public function mount() {
        $this->pool = $this->room->games
        ->flatMap(function ($game) {
            return $game->public_objectives->concat($game->private_objectives);
        });

        $this->pool_ids = $this->pool->mapWithKeys(function($objective) {
                return [ $objective->id => true ];
            })->toArray();

        $this->max_easy = $this->pool->where('difficulty', 1)->count();
        $this->max_medium = $this->pool->where('difficulty', 2)->count();
        $this->max_hard = $this->pool->where('difficulty', 3)->count();

        $this->pool_size = count(array_filter($this->pool_ids));
    }

    public function selectObjectives() {
        $valid = true;

        $total = $this->width * $this->height;

        if($this->choose_difficulty_amount) {
            if($this->nb_easy + $this->nb_medium + $this->nb_hard != $total) {
                $valid = false;
            }
        }
        if($this->pool_size < $total) {
            $valid = false;
        }

        if(!$valid) {
            return;
        }

        if($this->room->grid) {
            $grid = $this->room->grid;
            $grid->squares()->delete();
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
        
        $possible_objectives = Objective::findMany(array_keys($this->pool_ids, true, true));
        
        $picked = collect([]);

        if($this->choose_difficulty_amount) {
            $easy_objectives = $possible_objectives->where('difficulty', 1);
            $medium_objectives = $possible_objectives->where('difficulty', 2);
            $hard_objectives = $possible_objectives->where('difficulty', 3);

            $picked = $picked->concat($easy_objectives->random($this->nb_easy));
            $picked = $picked->concat($medium_objectives->random($this->nb_medium));
            $picked = $picked->concat($hard_objectives->random($this->nb_hard));
        } else {
            foreach($this->games_objectives_count as $game_id => $count) {
                $sub_objectives = $possible_objectives->where('game_id', $game_id);
                
                $picked = $picked->concat($sub_objectives->random($count));
            }
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
