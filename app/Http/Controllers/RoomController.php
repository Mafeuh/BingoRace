<?php

namespace App\Http\Controllers;

use App\Models\BingoGrid;
use App\Models\BingoGridSquare;
use App\Models\Game;
use App\Models\Room;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function setup() {
        return view("room.setup", [
            'room' => Room::find(session('last_joined_room_id')),
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

        $has_public = in_array('public', $valid['objective_type']);
        $has_private = in_array('private', $valid['objective_type']);

        foreach($games as $game) {
            if($has_public) {
                $total_objective_count += count($game->public_objectives ?? []);
            }
            if($has_private) {
                $total_objective_count += count($game->private_objectives ?? []);
            }
        }

        if($height * $width > $total_objective_count) {
            return redirect('/room/setup');
        }

        $room = Room::find(session('last_joined_room_id'));
        $room->has_public_objectives = $has_public;
        $room->has_private_objectives = $has_private;
        $room->has_team_objectives = false;
        $room->save();

        session()->put('new_grid_height', $height);
        session()->put('new_grid_width', $width);

        return redirect('/room/wait');
    }

    public function wait() {
        return view('room.waiting_room', [
            'room' => Room::find(session('last_joined_room_id'))
        ]);
    }

    public function start() {
        $room = Room::find(session('last_joined_room_id'));

        $width = session('new_grid_width');
        $height = session('new_grid_height');

        $games = Game::findMany(session('new_room_games_ids'));

        $objectives = array();

        foreach($games as $game) {
            if($room->has_public_objectives) {
                $objectives[] = $game->public_objectives;
            }
            if($room->has_private_objectives) {
                $objectives[] = $game->private_objectives;
            }
            if($room->has_team_objectives) {
                $objectives[] = $game->team_objectives;
            }
        }

        $collection = Collection::make($objectives)->flatten()->random($width * $height);

        $grid = BingoGrid::create([
            'room_id' => $room->id,
            'height' => $height,
            'width' => $width
        ]);

        foreach($collection as $objective) {
            BingoGridSquare::create([
                'grid_id' => $grid->id,
                'objective_id'=> $objective->id
            ]);
        }

        return view('room.play', [
            'grid'=> $grid,
            'objectives' => BingoGridSquare::where('grid_id', $grid->id)
        ]);
    }

    public function join() {
        $valid = request()->validate([
            'code' => ['required', 'string', 'min:5', 'max:5']
        ]);

        $room = Room::all()->where('code', $valid['code'])->first();

        session()->put('last_joined_room_id', $room->id);

        return redirect('/room/wait');
    }
}
