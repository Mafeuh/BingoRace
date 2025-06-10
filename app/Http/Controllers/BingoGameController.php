<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Room;
use App\Models\RoomSelectedGame;
use App\Rules\AtLeastOneCheckboxChecked;
use App\View\Components\redirect;
use Illuminate\Http\Request;

class BingoGameController extends Controller
{
    public static function start() {
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

        $new_room = Room::create([
            'creator_id' => auth()->user()->id
        ]);

        auth()->user()->last_joined_room_id = $new_room->id;
        auth()->user()->save();

        foreach($valid['game_checkboxes'] as $game_id) {
            RoomSelectedGame::create([
                'room_id' => $new_room->id,
                'game_id' => $game_id
            ]);
        }        
        
        return redirect('/room/setup');
    }
}
