<?php

namespace App\Http\Controllers;

use App\Models\BingoGrid;
use App\Models\BingoGridSquare;
use App\Models\Game;
use App\Models\Objective;
use App\Models\Room;
use App\Models\Team;
use App\View\Components\redirect;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function results() {
        $room = Room::find(auth()->user()->last_joined_room_id);

        $teams = $room->teams->map(function ($team) {
            $team->objectives_count = count($team->checked_objectives);
            return $team;
        });

        $sorted = $teams->sortByDesc('objectives_count')->values();

        $ranked = collect();
        $rank = 1;
        $previousCount = null;
        $position = 1;

        foreach ($sorted as $team) {
            if ($previousCount !== null && $team->objectives_count < $previousCount) {
                $rank = $position;
            }
        
            $team->rank = $rank;
            $ranked->push($team);
        
            $previousCount = $team->objectives_count;
            $position++;
        }

        return view('room.results', [
            'room' => $room,
            'ordered_teams' => $ranked
        ]);
    }

    public function start() {
        return view('room.start');
    }

    public function setup() {
        $room = Room::find(auth()->user()->last_joined_room_id);

        return view("room.setup", [
            'room' => $room,
            'games' => $room->games,
        ]);
    }

    public function setup_post() {
        $valid = request()->validate([
            'grid_height' => ['required', 'min:1', 'max:10'],
            'grid_width' => ['required', 'min:1', 'max:10'],
            'objective_type' => ['array'],
            'objective_type.*' => [],
            'room_id' => []
        ]);

        if(!array_key_exists('objective_type', $valid)) {
            return redirect('/room/setup');
        }
        $height = $valid['grid_height'];
        $width = $valid['grid_width'];
        $room = Room::find($valid['room_id']);

        $games = $room->games;

        $total_objective_count = 0;

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

        $room = Room::find(auth()->user()->last_joined_room_id);
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
        $r = Room::find(auth()->user()->last_joined_room_id);

        return view('room.waiting_room', [
            'room' => $r
        ]);
    }

    public function begin() {
        $room = Room::find(auth()->user()->last_joined_room_id);

        $room->started_at = now();
        $room->save();

        return redirect("/room/play");
    }

    public function play() {
        $room = Room::find(auth()->user()->last_joined_room_id);

        $cache_hide_time = Carbon::parse($room->started_at)->addSeconds(10)->setTimezone('UTC');

        if($room->started_at != null) {
            return view('room.play', [
                'room' => $room,
                'cache_hide_time' => $cache_hide_time->timestamp,
                'server_time' => now()->timestamp
            ]);
        } else {
            session()->flash('message', 'Cette salle n\'a pas encore commencé !');
            return redirect()->back();
        }
    }

    public function join() {
        $valid = request()->validate([
            'code' => ['required', 'string', 'min:5', 'max:5']
        ]);

        $room = Room::all()->where('code', mb_strtoupper($valid['code']))->first();

        if ($room) {
            auth()->user()->last_joined_room_id = $room->id;
            auth()->user()->save();
    
            return redirect('/room/wait');
        }

        session()->flash('error', 'Ce salon n\'existe pas !');
        return redirect()->back();
    }
}
