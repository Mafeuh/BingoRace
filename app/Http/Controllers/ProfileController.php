<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\UserProfile;
use App\Models\User;

class ProfileController extends Controller
{
    public function show_your_profile() {
        return $this->show_user_profile(auth()->user());
    }

    public function show_user_profile(User $user) {
        if($user == null) {
            $user = auth()->user;
        }

        $profile = UserProfile::where('user_id', $user->id)->first();
        
        if(!$profile) {
            $profile = UserProfile::create([
                'user_id' => $user->id,
            ]);
        }

        return view('profile.show', [
            'user' => $user,
            'profile' => $profile,
            'private_lock' => !$profile->is_public || auth()->user()->isAdmin || auth()->user() == $user,
        ]);
    }   
}
