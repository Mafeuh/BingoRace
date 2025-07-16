<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TeamColorSelector extends Component
{
    public $colors = [
        'red'       => '#ef4444',
        'orange'    => '#f97316',
        'amber'     => '#f59e0b',
        'yellow'    => '#eab308',
        'lime'      => '#84cc16',
        'green'     => '#22c55e',
        'emerald'   => '#10b981',
        'teal'      => '#14b8a6',
        'cyan'      => '#06b6d4',
        'sky'       => '#0ea5e9',
        'blue'      => '#3b82f6',
        'indigo'    => '#6366f1',
        'purple'    => '#a855f7',
        'fuchsia'   => '#d946ef',
        'pink'      => '#ec4899',
        'rose'      => '#f43f5e',
    ];
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.team-color-selector', [
            'colors' => $this->colors
        ]);
    }
}
