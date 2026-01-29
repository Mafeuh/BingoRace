<?php

namespace App\Livewire;

use Livewire\Component;

class GridSample extends Component
{
    public $games_repartition = []; 
    public $games = [];

    public $objectives = [];

    public int $width;
    public int $height;

    protected $listeners = ['trigger-distribute' => 'reload'];

    public function reload($vars) {
        $this->width = $vars['width'];
        $this->height = $vars['height'];
        $this->games_repartition = $vars['repartition'];

        $this->generate_dummies();
    }

    public function generate_dummies() {
        $this->objectives = [];
        
        foreach($this->games_repartition as $game => $value) {
            for($i = 0; $i < $value; $i++) {
                $this->objectives[] = array_search($game, $this->games->pluck('id')->toArray()) + 1;
            }
        }
    }

    public function test() {
        dd($this->games_repartition);
    }

    public function render()
    {
        $this->generate_dummies();
        return view('livewire.grid-sample');
    }
}
