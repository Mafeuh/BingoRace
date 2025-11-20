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

    public ?HomepagePost $post = null;

    public $previewed_text = "";

    public function render()
    {
        if($this->post) {
            $this->post_title = $this->post->title;
            $this->post_description = $this->post->description;
            $this->post_lang = $this->post->lang_slug;
        }
        return view('livewire.post-creation-form');
    }

    public function confirm() {
        if($this->post) {
            $this->post->title = $this->post_title;
            $this->post->description = $this->post_description;
            $this->post->lang_slug = $this->post_lang;
            $this->post->save();

            session()->flash('message', __('posts.edit.validation_message'));
        } else {
            HomepagePost::create([
                'title' => $this->post_title,
                'description' => $this->post_description,
                'lang_slug' => $this->post_lang,
                'author_id' => auth()->user()->id
            ]);
            session()->flash('message', __('posts.new.validation_message'));
        }

    }

    public function preview() {
        $this->previewed_text = $this->post_description;
    }
}
