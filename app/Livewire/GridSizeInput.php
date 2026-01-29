<?php

namespace App\Livewire;

use Livewire\Component;

class GridSizeInput extends Component
{
    public $width = 5;
    public $height = 5;

    public function render()
    {
        return view('livewire.grid-size-input');
    }
}
