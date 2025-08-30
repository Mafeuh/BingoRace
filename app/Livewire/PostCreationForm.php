<?php

namespace App\Livewire;

use Livewire\Component;

class PostCreationForm extends Component
{
    public $langs = [
        'fr' => "Français",
        'en' => "English",
    ];

    public $selected_lang = "fr";

    public function render()
    {
        return view('livewire.post-creation-form');
    }

    public function addLanguage() {
        dd($this->selected_lang);
    }
}
