<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Objective;
use App\Models\PrivateObjective;
use App\Models\PublicObjective;
use App\View\Components\redirect;

class GamesController extends Controller
{
    public static function new() {
        return view('games.new');
    }

    public function store() {
        $valid = request()->validate([
            'name' => ['required'],
            'preview_image' => ['image', 'mimes:png,jpg,jpeg,gif', 'max:2048' ],
            'public_objectives' => [],
            'private_objectives' => []
        ]);

        $name = $valid['name'];
        $public_objectives = mb_split('\r\n', $valid['public_objectives']);
        $private_objectives = mb_split('\r\n', $valid['private_objectives']);

        $imageUrl = '';

        if(key_exists('preview_image', $valid)) {
            $path = request()->file('preview_image')->store('public/images');
            $imageUrl = str_replace('public', 'storage', $path);
        }

        $g = Game::create([
            'name' => $name,
            'image_url' => $imageUrl,
            'creator_id' => auth()->user()->hasPermission('admin') ? null : auth()->user()->id
        ]);

        if($valid['public_objectives']) {
            foreach($public_objectives as $obj) {
                $pub = PublicObjective::create([]);
                $pub->objective()->create([
                    'game_id' => $g->id,
                    'description' => $obj
                ]);
            }
        }
        if($valid['private_objectives']) {
            foreach($public_objectives as $obj) {
                $priv = PrivateObjective::create([
                    'user_id' => auth()->user()->id
                ]);
                $priv->objective()->create([
                    'game_id' => $g->id,
                    'description' => $obj
                ]);
            }
        }

        $obj_count = sizeof($public_objectives) + sizeof($private_objectives);

        session()->flash('message', 'Le jeu '.$name.' a bien été créé'.($obj_count > 0 ? `, avec $obj_count objectifs` : '').'.');

        return redirect('/games/'.$g->id);
    }

    public function list() {
        $public_games = Game::all()->whereNull('creator_id');

        $user_games = Game::all()->where('creator_id', '===', auth()->user()->id);

        return view('games.list', [
            'public_games' => $public_games,
            'user_games'=> $user_games
        ]);
    }

    public function show(Game $game) {
        $game_id = $game->id;
        $game = Game::find($game_id);

        if($game == null) {
            return redirect('/');
        }

        if($game->creator_id != null && $game->creator->id != auth()->user()->id) {
            return redirect('/');
        }

        return view('games.show', [
            'game'=> $game
        ]);
    }

    public function delete(Request $request) {
        $game_id = $request->get('game_id');

        $game = Game::find($game_id);

        $game->public_objectives()->delete();
        $game->private_objectives()->delete();

        session()->flash('message', 'Le jeu '.$game->name.' a été supprimé.');

        $game->delete();
        
        return to_route('games.list');
    }
}
