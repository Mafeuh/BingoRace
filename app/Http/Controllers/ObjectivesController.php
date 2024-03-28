<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Objective;
use Illuminate\Http\Request;

class ObjectivesController extends Controller
{
    public static function new(Game $game){
        return view("objectives.new", ["game"=> $game]);
    }

    public static function post(Game $game){
        $valid = request()->validate([
            'description' => [
                'required',
                'string',
                'min:10',
                'max:255'
            ]
        ]);

        Objective::create([
            'description'=> $valid['description'],
            'game_id' => $game->id,
            'creator_id' => auth()->user()->id
        ]);

        return view("games.show", ["game"=> $game]);
    }
}
