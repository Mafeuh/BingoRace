<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomepagePost;

class PostsController extends Controller
{
    public function new() {
        return view('posts.new');
    }

    public function edit(HomepagePost $post) {
        return view('posts.edit', [
            'post' => $post
        ]);
    }
}
