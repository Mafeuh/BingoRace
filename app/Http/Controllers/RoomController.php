<?php

namespace App\Http\Controllers;

use App\Events\RoomStarted;
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

    public function wait() {
        $r = Room::find(auth()->user()->last_joined_room_id);

        if($r->started_at) {

            return redirect("/room/play");
        } else {
            return view('room.waiting_room', [
                'room' => $r
            ]);
        }

    }

    public function begin() {
        $room = Room::find(auth()->user()->last_joined_room_id);

        $room->started_at = now();
        $room->started_at_unix = now()->timestamp;
        $room->save();

        broadcast(new RoomStarted($room->id));

        return redirect("/room/play");
    }

    public function play() {
        $room = Room::find(auth()->user()->last_joined_room_id);

        $cache_hide_time = Carbon::parse($room->started_at)->addSeconds(10)->setTimezone('UTC');

        if($room->started_at != null) {
            return view('room.play', [
                'room' => $room,
                'ends_at' => $room->started_at_unix + $room->duration_seconds,
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
