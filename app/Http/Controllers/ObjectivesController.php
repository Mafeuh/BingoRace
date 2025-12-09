<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Objective;
use App\Models\PrivateObjective;
use App\Models\PublicObjective;
use App\View\Components\redirect;
use Illuminate\Http\Request;

class ObjectivesController extends Controller
{
    public static function new(Game $game){
        return view("objectives.new", ["game"=> $game]);
    }

    public function switch_visibility(Objective $objective) {
        $objective->objectiveable()->delete();
        $new = null;
        if($objective->objectiveable_type == "App\Models\PublicObjective") {
            $new = PrivateObjective::create([
                'user_id' => $objective->creator_id ?? -1
            ]);
        } elseif($objective->objectiveable_type == "App\Models\PrivateObjective") {
            $new = PublicObjective::create([]);
        }
        $objective->objectiveable()->associate($new);
        $objective->save();
    }

    public function post(Game $game){
        $objectives = request()->objectives;
        $visibilities = request()->visibilities;
        $difficulties = request()->difficulties;

        for($i = 0; $i < count($objectives); $i++) {
            $obj = $objectives[$i];
            $vis = $visibilities[$i];
            $dif = $difficulties[$i];

            if($obj) {
                $n = null;
                if($vis == "public") {
                    $n = PublicObjective::create([]);
                } elseif($vis == "private") {
                    $n = PrivateObjective::create([
                        'user_id' => auth()->user()->id
                    ]);
                }
                if($dif > 3) $dif = 3;
                if($dif < 1) $dif = 1;
                $n->objective()->create([
                    'description' => $obj,
                    'game_id' => $game->id,
                    'creator_id' => auth()->user()->id,
                    'difficulty' => $dif
                ]);
            }
            
        }

        return redirect("/games/".$game->id);
    }

    public function edit(Objective $objective) {
        return view('objectives.edit', [
            'objective' => $objective
        ]);
    }

    public function edit_post(Objective $objective) {
        if(auth()->user()->id != $objective->game->creator_id && !auth()->user()->isAdmin()) {
            session()->flash('error', __('auth.invalid_access'));

            return redirect()->back();
        }
        
        $new_text = request()->input('description');

        $objective->description = $new_text;
        $objective->save();

        session()->flash('message', "L'objectif a bien été renommé.");

        return redirect('/games/'.$objective->game->id);
    }

    

    public function delete(int $id)
    {
        $objective = Objective::find($id);

        if($objective->game->creator_id == auth()->user()->id || auth()->user()->isAdmin()) {
            $objective->hidden = true;
            $objective->save();
            session()->flash('message', 'Objectif supprimé !');
        } else {
            session()->flash('error', 'Vous ne pouvez pas supprimer cet objectif !');
        }


        return redirect()->back();
    }
}
