<?php

namespace App\Http\Controllers;

use App\Models\BingoGrid;
use App\Models\BingoGridSquare;
use App\Models\Game;
use App\Models\Objective;
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

        $games_ids = session('new_room_games_ids');

        $total_objective_count = 0;

        $games = Game::findMany($games_ids);

        $has_public = in_array('public', $valid['objective_type']);
        $has_private = in_array('private', $valid['objective_type']);
        $has_team = false;

        foreach($games as $game) {
            if($has_public) {
                $total_objective_count += count($game->public_objectives ?? []);
            }
            if($has_private) {
                $total_objective_count += count($game->private_objectives ?? []);
            }
        }

        if($height * $width > $total_objective_count) {
            session()->flash('error', 'Pas assez d\'objectifs pour remplir les conditions.');

            return redirect('/room/setup');
        }

        $objectives = Objective::whereIn('game_id', $games->pluck('id')
            ->toArray())
            ->inRandomOrder()
            ->limit($height * $width)
            ->get();

        $room = Room::find(session('last_joined_room_id'));
        $room->grid()->create([
            'width' => $width,
            'height' => $height
        ]);

        foreach ($objectives as $key => $objective_it) {
            if ($objective_it->objectiveable_type == 'App\Models\PublicObjective' && !$has_public) {
                $objectives->forget($key);
            } else if ($objective_it->objectiveable_type == 'App\Models\PrivateObjective' && !$has_private) {
                $objectives->forget($key);
            } else if ($objective_it->objectiveable_type == 'App\Models\TeamObjective' && !$has_team) {
                $objectives->forget($key);
            } else {
                BingoGridSquare::create([
                    'grid_id' => $room->grid->id,
                    'objective_id' => $objective_it->id
                ]);
            }
        }

        return redirect('/room/wait');
    }

    public function wait() {
        return view('room.waiting_room', [
            'room' => Room::find(session('last_joined_room_id'))
        ]);
    }

    public function start() {
        $room = Room::find(session('last_joined_room_id'));

        $room->started = true;
        $room->save();

        return redirect("/room/play");
    }

    public function play() {
        $room = Room::find(session('last_joined_room_id'));

        return view('room.play', [
            'room' => $room
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
