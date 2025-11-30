<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static $available_languages = [
        'fr' => "Français", 
        'en' => "English"
    ];

    public static function GeneratePublicGames() {
        $games = [
            'Minecraft' => 'storage/images/minecraft.jpg',
            'Lethal Company'=> 'storage/images/lethal.png',
            'Sea of Thieves'=> 'storage/images/sot.jpg',
        ];
        foreach ($games as $game => $url) {
            Game::create([
                'name' => $game,
                'image_url' => $url
            ]);
        }
    }

    public static function getPublicGames() {
        return Game::where('is_public',  1)->where('visible', 1)->where('is_official', 0)->where('lang', app()->getLocale());
    }

    public static function getOfficialGames() {
        return Game::where('is_official', 1)->where('visible', 1)->where('lang', app()->getLocale());
    }

    public static function getAuthPrivateGames() {
        return auth()->user()->private_games->where('visible', 1)->where('is_public',  0)->where('is_official', 0)->where('lang', app()->getLocale());
    }

    public function public_objectives()
    {
        return $this->hasMany(Objective::class, 'game_id')->where('objectiveable_type', 'App\Models\PublicObjective')->where('hidden', false);
    }

    public function private_objectives()
    {
        return $this->hasMany(Objective::class, 'game_id')->where('objectiveable_type', 'App\Models\PrivateObjective')->where('hidden', false);
    }

    public function team_objectives()
    {
        return $this->hasMany(Objective::class, 'game_id')->where('objectiveable_type', 'App\Models\TeamObjective')->where('hidden', false);
    }

    public function hidden_public_objectives()
    {
        return $this->hasMany(Objective::class, 'game_id')->where('objectiveable_type', 'App\Models\PublicObjective')->where('hidden', true);
    }

    public function hidden_private_objectives()
    {
        return $this->hasMany(Objective::class, 'game_id')->where('objectiveable_type', 'App\Models\PrivateObjective')->where('hidden', true);
    }

    public function hidden_team_objectives()
    {
        return $this->hasMany(Objective::class, 'game_id')->where('objectiveable_type', 'App\Models\TeamObjective')->where('hidden', true);
    }

    public function creator() {
        return $this->belongsTo(User::class,'creator_id', 'id');
    }
}
