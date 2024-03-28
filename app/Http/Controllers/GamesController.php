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
            'image_url' => []
        ]);

        $name = $valid['name'];
        $image = $valid['image_url'];

        Game::create([
            'name' => $name,
            'image_url' => $image,
            'creator_id' => auth()->user()->id
        ]);

        return to_route('home');
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
        $game = Game::with([
            'public_objectives',
            'user_objectives',
            'creator'])->find($game_id);

        return view('games.show', [
            'game'=> $game
        ]);
    }
}
