<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\HomepagePost;

class PostsList extends Component
{
    public $posts;

    public function mount() {
        $this->posts = $this->get_posts(); 
    }

    public function switch_state(HomepagePost $post) {
        $post->hidden = !$post->hidden;
        $post->save();

        $this->posts = $this->get_posts();
    }

    public function get_posts() {
        if (auth()->user()->isAdmin()) {
            return HomepagePost::where('lang_slug', app()->getLocale())->orderBy('created_at', 'desc')->get();
        } else {
            return HomepagePost::where('lang_slug', app()->getLocale())->where('hidden', false)->orderBy('created_at', 'desc')->get();
        }
    }

    public function render()
    {
        return view('livewire.posts-list');
    }
}
