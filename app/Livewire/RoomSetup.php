<?php

namespace App\Livewire;

use App\Models\Room;
use App\Models\BingoGrid;
use App\Models\Objective;
use App\Models\BingoGridSquare;
use Livewire\Component;

class RoomSetup extends Component
{
    protected $listeners = ['update-quotas' => 'updateQuotas'];
    
    public Room $room;
    public int $width = 5;
    public int $height = 5;

    public $games_repartition = []; 
    public $pool_ids = []; // [id => true] par défaut
    
    public bool $choose_difficulty_amount = false;
    public int $nb_easy = 0;
    public int $nb_medium = 0;
    public int $nb_hard = 0;

    public int $max_easy;
    public int $max_medium;
    public int $max_hard;

    public $quotas = [];

    public function updateQuotas($quotas)
    {
        // Livewire 3 envoie les données sous forme de tableau associatif
        $this->quotas = $quotas;
    }

    public function mount()
    {
        // 1. Répartition par défaut
        $this->games_repartition = $this->room->games->mapWithKeys(fn($g) => [$g->id => 50])->toArray();

        // 2. ACTIVER TOUT PAR DÉFAUT
        $allObjectives = $this->room->games->flatMap(function ($game) {
            return $game->public_objectives->concat($game->private_objectives);
        });
        $this->pool_ids = $allObjectives->pluck('id')->mapWithKeys(fn($id) => [$id => true])->toArray();

        // 3. Quotas de difficulté par défaut
        $total = $this->width * $this->height;
        $this->nb_easy = ceil($total / 3);
        $this->nb_medium = floor($total / 3);
        $this->nb_hard = $total - ($this->nb_easy + $this->nb_medium);

        $this->max_easy = $allObjectives->where('difficulty', 1)->count();
        $this->max_medium = $allObjectives->where('difficulty', 2)->count();
        $this->max_hard = $allObjectives->where('difficulty', 3)->count();
    }

    public function submit()
    {
        $activeIds = array_keys(array_filter($this->pool_ids));
        $possible_objectives = Objective::whereIn('id', $activeIds)->get();

        if ($possible_objectives->count() < ($this->width * $this->height)) {
            $this->dispatch('notify-error', 'Nombre d\'objectifs insuffisant.');
            return;
        }

        $grid = BingoGrid::updateOrCreate(
            ['room_id' => $this->room->id],
            ['width' => $this->width, 'height' => $this->height]
        );
        $grid->squares()->delete();

        $picked = collect([]);

        if($this->choose_difficulty_amount) {
            $easy_objectives = $possible_objectives->where('difficulty', 1);
            $medium_objectives = $possible_objectives->where('difficulty', 2);
            $hard_objectives = $possible_objectives->where('difficulty', 3);

            $picked = $picked->concat($easy_objectives->random($this->nb_easy));
            $picked = $picked->concat($medium_objectives->random($this->nb_medium));
            $picked = $picked->concat($hard_objectives->random($this->nb_hard));
        } else {
            foreach($this->quotas as $game_id => $count) {
                $sub_objectives = $possible_objectives->where('game_id', $game_id);
                
                $picked = $picked->concat($sub_objectives->random($count));
            }
        }

        $picked = $picked->shuffle();

        foreach ($picked as $obj) {
            BingoGridSquare::create([
                'grid_id' => $grid->id,
                'objective_id' => $obj->id
            ]);
        }

        return redirect('/room/wait');
    }

    public function render()
    {
        return view('livewire.room-setup');
    }
}