<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Room;
use App\Rules\AtLeastOneCheckboxChecked;
use Illuminate\Http\Request;

class BingoGameController extends Controller
{
    public static function start() {
        session()->remove("last_joined_room_id");
        session()->remove("new_room_games_ids");

        return view('bingo.select_games', [
            'public_games' => Game::whereNull('creator_id')->get(),
            'user_games' => Game::where('creator_id', '==', auth()->user()->id)->get()
        ]);
    }

    public static function start_post() {
        $valid = request()->validate([
            'game_checkboxes' => ['array'],
            'game_checkboxes.*' => []
        ]);

        if(!array_key_exists('game_checkboxes', $valid)) {
            return redirect('/start');
        }
        
        session()->put('new_room_games_ids', $valid['game_checkboxes']);

        return redirect('/room/setup');
    }
}
