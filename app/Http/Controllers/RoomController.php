<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function setup() {
        return view("room.setup", [
            'room' => Room::find(session('new_room_id')),
            'games' => Game::findMany(session('new_room_games_ids')),
        ]);
    }

    public function setup_post() {
        $valid = request()->validate([
            'grid_height' => ['required', 'min:1', 'max:10'],
            'grid_width' => ['required', 'min:1', 'max:10'],
            'objective_type' => ['array'],
            'objective_type.*' => []
        ]);
        if(!array_key_exists('objective_type', $valid)) {
            return redirect('/room/setup');
        }
        $height = $valid['grid_height'];
        $width = $valid['grid_width'];

        $total_objective_count = 0;

        $games = Game::findMany(session('new_room_games_ids'));

        foreach($games as $game) {
            if(in_array('public', $valid['objective_type'])) {
                $total_objective_count += count($game->public_objectives ?? []);
            }
            if(in_array('private', $valid['objective_type'])) {
                $total_objective_count += count($game->private_objectives ?? []);
            }
        }
        if($height * $width > $total_objective_count) {
            return redirect('/room/setup');
        }

        return redirect('/room/wait');
    }

    public function wait() {
        return view('room.waiting_room', [
            'room' => Room::find(session('new_room_id'))
        ]);
    }
}
