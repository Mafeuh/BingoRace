<?php

namespace App\Http\Controllers;

use App\Models\FlaggedGame;
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

    public function change_image(Game $game) {
        $valid = request()->validate([
            'image' => ['image', 'mimes:png,jpg,jpeg,gif', 'max:2048' ]
        ]);

        $imageUrl = '';

        $path = request()->file('image')->store('public/images');
        $imageUrl = str_replace('public', 'storage', $path);
        
        $game->image_url = $imageUrl;
        $game->save();

        session()->flash('message', __('game.show.danger.change_image.valid'));

        return redirect()->back();
    }

    public function set_language(Game $game) {
        $new_language = request()->input('lang');

        if(!in_array($new_language, array_keys(Game::$available_languages))) {
            session()->flash('error', __('game.show.language.edit.invalid'));

            return redirect()->back();
        }

        $game->lang = $new_language;
        $game->save();

        session()->flash('message', __('game.show.language.edit.valid', ['lang' => Game::$available_languages[$new_language]]));

        return redirect()->back();
    }

    public function set_visibility(Game $game) {
        $new_visibility = request()->input('visibility');

        $message_key = "game.show.visibility.message.valid." . $new_visibility;

        if($new_visibility == 'official_on' || $new_visibility == 'official_off') {
            if(auth()->user()->isAdmin()) {
                $game->is_official = $new_visibility == 'official_on';
                $game->save();

                session()->flash('message', __($message_key));
            } else {
                session()->flash('error', __($message_key));
            }
            return redirect()->back();
        }

        if($game->creator_id == auth()->user()->id || auth()->user()->isAdmin()) {
            if($new_visibility == 'public') {
                $game->is_public = true;
                $game->save();
            }
            if($new_visibility == 'private') {
                $game->is_public = false;
                $game->save();
            }
            session()->flash('message', __(key: $message_key));
            return redirect()->back();
        }
        session()->flash('error', __(key: 'game.show.visibility.message.invalid'));
        return redirect()->back();
    }

    public function store() {
        $valid = request()->validate([
            'name' => ['required', 'max:255'],
            'preview_image' => ['image', 'mimes:png,jpg,jpeg,gif,webp', 'max:2048' ],
            'visibility' => ['required'],
            'lang' => ['required'],
        ]);

        $lang = $valid['lang'];

        if(!in_array($lang, array_keys(Game::$available_languages))) {
            session()->flash('error', __('game.creation.form.language.invalid'));

            return redirect()->back();
        }
        
        $visibility = $valid['visibility'];

        if($visibility == "official") {
            if(!auth()->user()->isAdmin()){
                session()->flash('error', __('game.creation.visibility.unallowed.official'));
    
                return redirect()->back();
            }

            $is_official = true;
            $is_public = false;
        }
        if($visibility == "public") {
            $is_official = false;
            $is_public = true;
        }
        if($visibility == "private") {
            $is_official = false;
            $is_public = false;
        }
        
        $name = $valid['name'];
       
        $imageUrl = '';

        if(key_exists('preview_image', $valid)) {
            $path = request()->file('preview_image')->store('public/images');
            $imageUrl = str_replace('public', 'storage', $path);
        }

        $g = Game::create([
            'name' => $name,
            'image_url' => $imageUrl,
            'creator_id' => auth()->user()->id,
            'is_official' => $is_official,
            'is_public' => $is_public,
            'lang' => $lang
        ]);

        session()->flash('message', 'Le jeu '.$name.' a bien été créé !');

        return redirect('/games/'.$g->id);
    }

    public function list() {
        return view('games.list');
    }

    public function flag(Game $game) {
        $flagged = FlaggedGame::create([
            'game_id' => $game->id,
            'reason' => request()->input('reason')
        ]);

        session()->flash('message', 'Le jeu a été report');

        return redirect()->back();
    }

    public function show(Game $game) {
        $public_objectives = $game->public_objectives();
        $private_objectives = $game->private_objectives();


        if(($game->is_official || $game->is_public || $game->creator_id == auth()->user()->id) || auth()->user()->isAdmin) {
            return view('games.show', [
                'game'=> $game
            ]);
        }
        return redirect()->back();
    }

    public function delete(Request $request) {
        $game_id = $request->get('game_id');
        
        $game = Game::find($game_id);

        if(auth()->user()->isAdmin() || auth()->user()->id == $game->creator_id) {
            session()->flash('message', 'Le jeu '.$game->name.' a été supprimé.');
    
            $game->visible = false;
            $game->save();
            
            return to_route('games.list');
        }
        session()->flash('error', 'Vous n\'avez pas la permission de supprimer ce jeu !');

        return redirect()->back();

    }

    public function rename(Request $request) {
        $game_id = $request->get('game_id');
        
        $game = Game::find($game_id);

        if(auth()->user()->isAdmin() || auth()->user()->id == $game->creator_id) {
            $new_name = $request->get('new_name');
            $old_name = $game->name;

            $game->name = $new_name;
            $game->save();

            session()->flash('message', 'Le jeu '.$old_name.' a été renommé en '.$new_name.'.');
                
            return redirect()->back();
        }
        session()->flash('error', 'Vous n\'avez pas la permission de renommer ce jeu !');

        return redirect()->back();
    }
}
