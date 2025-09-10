<?php

namespace App\Livewire;

use App\Models\Objective;
use Livewire\Attributes\On;
use Livewire\Component;

class WeeklySelectedObjectivesForm extends Component
{    
    public $selected_objectives_ids = [];

    #[On('select_obj')]
    public function select_objective(int $id) {
        if(in_array($id, $this->selected_objectives_ids)) {
            $this->selected_objectives_ids = array_diff($this->selected_objectives_ids, [$id]);
        } else {
            $this->selected_objectives_ids[] = $id;
        }
    }
    public function render()
    {
        return view('livewire.weekly-selected-objectives-form', [
            'selected_objectives' => Objective::with('game')
                                                ->findMany($this->selected_objectives_ids)
                                                ->sortBy(fn($obj) => $obj->game->id . '_' . $obj->description)
        ]);
    }
}
