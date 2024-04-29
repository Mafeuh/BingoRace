<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $guarded = [];

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

    public function public_objectives()
    {
        return $this->hasMany(Objective::class, 'game_id')->where('objectiveable_type', 'App\Models\PublicObjective');
    }

    public function private_objectives()
    {
        return $this->hasMany(Objective::class, 'game_id')->where('objectiveable_type', 'App\Models\PrivateObjective');
    }

    public function team_objectives()
    {
        return $this->hasMany(Objective::class, 'game_id')->where('objectiveable_type', 'App\Models\TeamObjective');
    }

    public function creator() {
        return $this->belongsTo(User::class,'creator_id', 'id');
    }
}
