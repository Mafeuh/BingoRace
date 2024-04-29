<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Objective;
use App\Models\PrivateObjective;
use App\Models\PublicObjective;
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
            ],
            'visibility' => ['required']
        ]);

        if($valid['visibility'] == 'private') {
            $obj = PrivateObjective::create([
                'user_id' => auth()->user()->id
            ]);

            $obj->objective()->create(['description' => $valid['description'], 'game_id' => $game->id]);
        }

        else if($valid['visibility'] == 'public') {
            $obj = PublicObjective::create([]);

            $obj->objective()->create(['description'=> $valid['description'], 'game_id' => $game->id]);
        }

        else if($valid['visibility'] == 'team') {
            //TODO: Implémenter la fonctionnalité d'équipe!

            $obj = PrivateObjective::create([
                'user_id'=> auth()->user()->id
            ]);

            $obj->objective()->create(['description'=> $valid['description'], 'game_id' => $game->id]);
        }

        return redirect("/games/$game->id");
    }

    public function delete(int $id)
    {
        $objective = Objective::find($id);
        $objective->delete();

        return redirect()->back();
    }
}
