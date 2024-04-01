<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Room;
use Illuminate\Http\Request;

class BingoGameController extends Controller
{
    public static function start() {
        request()->session()->remove("new_room");
        request()->session()->remove("new_room_games_ids");

        $public_games = Game::whereNull("creator_id")->get();
        $user_games = Game::where('creator_id', '==', auth()->user()->id)->get();

        return view("bingo.select_games", [
            'public_games' => $public_games,
            'user_games'=> $user_games
        ]);
    }

    public static function start_post() {
        if(request()->session()->exists('new_room')) {
            $room = request()->session()->get('new_room');
            $games = request()->session()->get('new_room_games_ids');

            return view('room.setup', [
                'games' => $games,
                'room' => $room
            ]);
        }

        $valid = request()->validate([
            'game_checkboxes'=> ['required'],
        ]);

        $games = Game::whereIn('id', $valid['game_checkboxes'])->get();

        $new_room = Room::create([
            'creator_id' => auth()->user()->id
        ]);

        request()->session()->put('new_room', $new_room);
        request()->session()->put('new_room_games_ids', $games);

        return view('room.setup', [
            'games' => $games,
            'room' => $new_room
        ]);
    }

    public static function check_and_wait() {
        $valid = request()->validate([
            'width' => ['required', 'integer', 'max:10', 'min:1'],
            'height' => ['required', 'integer', 'max:10', 'min:1'],
        ]);
    }
}
