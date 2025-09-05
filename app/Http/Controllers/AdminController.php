<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Room;
use App\View\Components\redirect;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $rooms = Room::orderBy('id', 'desc')->paginate();

        return view('admin.index', [
            'rooms' => $rooms,
        ]);
    }

    public function join_room() {
        $room = request()->input('confirm');

        auth()->user()->last_joined_room_id = $room;
        auth()->user()->save();

        return redirect('room/wait');
    }
}
