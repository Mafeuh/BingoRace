<?php

namespace App\Http\Controllers;

use App\Events\RoomStarted;
use App\Models\BingoGrid;
use App\Models\BingoGridSquare;
use App\Models\Game;
use App\Models\Objective;
use App\Models\Room;
use App\Models\Team;
use App\Models\AnonymousParticipant;
use App\View\Components\redirect;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function results() {
        $room = Room::find(session()->get('room_id'));

        if(!$room) {
            return redirect()->back();
        }

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
        $room = Room::find(session()->get('room_id'));

        return view("room.setup", [
            'room' => $room,
            'games' => $room->games,
        ]);
    }

    public function wait() {
        $r = Room::find(session()->get('room_id'));

        if($r->started_at) {

            return redirect("/room/play");
        } else {
            return view('room.waiting_room', [
                'room' => $r
            ]);
        }

    }

    public function begin() {
        $room = Room::find(session()->get('room_id'));

        $room->started_at = now();
        $room->started_at_unix = now()->timestamp;
        $room->save();

        broadcast(new RoomStarted($room->id));

        return redirect("/room/play");
    }

    public function play() {
        $room = Room::find(session()->get('room_id'));

        if(!$room) {

            session()->flash('error', 'PROBLEME hihi');

            return redirect()->back();
        }

        $cache_hide_time = Carbon::parse($room->started_at)->addSeconds(10)->setTimezone('UTC');

        if(auth()->check()) {
            $team = Team::find(
                auth()->user()->participations->pluck('participant.team_id')
                )->where('room_id', $room->id)->first();
        } else {
            $an = AnonymousParticipant::find(session()->get('ap_i'));

            if($an->participant) {
                $team = Team::find(
                    $an->participant->team_id
                );
            } else {
                $team = null;
            }
        }

        if($room->started_at != null) {
            return view('room.play', [
                'room' => $room,
                'teams' => $room->teams,
                'team' => $team,
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
            session(['room_id' => $room->id]);

            return redirect('/room/wait');
        }

        session()->flash('error', 'Ce salon n\'existe pas !');
        return redirect()->back();
    }
}
