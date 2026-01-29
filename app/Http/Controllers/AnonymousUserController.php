<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnonymousParticipant;

class AnonymousUserController extends Controller
{
    private function get_an_partipant() {
        return AnonymousParticipant::find(session()->get('ap_i'));
    }
    public function set_name() {
        if(!auth()->check()) {
            $an = $this->get_an_partipant();
            return view('unauth.set_name', [
                'name' => $an->username
            ]);
        }
        return redirect()->back();
    }

    public function register_name() {
        $name = request()->name;

        $an = $this->get_an_partipant();
        $an->username = $name;
        $an->save();

        session()->flash('message', 'Pseudo changé!');

        return redirect(session()->get('next_req'));
    }
}
