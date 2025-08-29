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

    public static function post(Game $game){
        $valid = request()->validate([
            'objectives' => ['string', 'required'],
            'visibility' => ['string', 'required']
        ]);

        $objectives = mb_split('\r\n', $valid['objectives']);

        $too_long_error = 0;
        
        if($valid['objectives']) {
            if($valid['visibility'] == 'public') {
                foreach($objectives as $obj) {
                    if(strlen($obj) <= 255) {
                        $pub = PublicObjective::create([]);
                        $pub->objective()->create([
                            'game_id' => $game->id,
                            'description' => $obj
                        ]);
                    } else $too_long_error += 1;
                }
            } elseif($valid['visibility'] == 'private') {
                foreach($objectives as $obj) {
                    if(strlen($obj) <= 255) {
                        $pub = PrivateObjective::create([
                            'user_id' => auth()->user()->id
                        ]);
                        $pub->objective()->create([
                            'game_id' => $game->id,
                            'description' => $obj
                        ]);
                    } else $too_long_error += 1;
                }
            }
        }

        if($too_long_error > 0) {
            session()->flash('message', (sizeof($objectives) - $too_long_error) . ' ajouté(s) à ' . $game->name . " (" . $too_long_error . " étaient trop longs.)");
        } else {
            session()->flash('message', sizeof($objectives) . ' ajouté(s) à ' . $game->name);
        }


        return redirect()->back();
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
