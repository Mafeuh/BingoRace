<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class BingoGameController extends Controller
{
    public static function start() {
        $public_games = Game::whereNull("creator_id")->get();
        $user_games = Game::where('creator_id', '==', auth()->user()->id)->get();

        return view("bingo.start", [
            'public_games' => $public_games,
            'user_games'=> $user_games
        ]);
    }
}
