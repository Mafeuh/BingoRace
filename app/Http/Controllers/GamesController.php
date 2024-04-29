<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;


class GamesController extends Controller
{
    public static function new() {
        return view('games.new');
    }

    public static function store() {
        $valid = request()->validate([
            'name' => ['required'],
            'image' => ['image', 'mimes:png,jpg,jpeg,gif', 'max:2048' ]
        ]);

        $name = $valid['name'];

        $imageUrl = '';

        if(key_exists('image', $valid)) {
            $path = request()->file('image')->store('public/images');
            $imageUrl = str_replace('public', 'storage', $path);
        }

        Game::create([
            'name' => $name,
            'image_url' => $imageUrl,
            'creator_id' => auth()->user()->id
        ]);

        return redirect('/games/list');
    }

    public static function list() {
        $public_games = Game::all()->whereNull('creator_id');

        $user_games = Game::all()->where('creator_id', '===', auth()->user()->id);

        return view('games.list', [
            'public_games' => $public_games,
            'user_games'=> $user_games
        ]);
    }

    public static function show(Game $game) {
        $game_id = $game->id;
        $game = Game::find($game_id);

        if($game == null) {
            return redirect('/');
        }

        if($game->creator_id != null && $game->creator->id != auth()->user()->id) {
            return redirect('/');
        }

        return view('games.show', [
            'game'=> $game
        ]);
    }
}
