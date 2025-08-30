<?php

namespace App\Livewire;

use App\Models\HomepagePost;
use Livewire\Component;

class PostCreationForm extends Component
{
    public $langs = [
        'fr' => "Français",
        'en' => "English",
    ];

    public $post_title = "";
    public $post_description = "";
    public $post_lang = "fr";

    public $previewed_text = "";

    public function render()
    {
        return view('livewire.post-creation-form');
    }

    public function addLanguage() {
        HomepagePost::create([
            'title' => $this->post_title,
            'description' => $this->post_description,
            'lang_slug' => $this->post_lang,
            'author_id' => auth()->user()->id
        ]);

        session()->flash('message', __('posts.new.validation_message'));
    }

    public function preview() {
        $this->previewed_text = $this->post_description;
    }
}
