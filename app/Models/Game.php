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
            'Minecraft' => '',
            'Lethal Company'=> '',
            'Sea of Thieves'=> '',
        ];
        foreach ($games as $game => $url) {
            Game::create([
                'name' => $game,
                'image_url' => $url
            ]);
        }
    }

    public function public_objectives() {
        return $this->hasMany(Objective::class, 'game_id', 'id')->whereNull('creator_id');
    }

    public function user_objectives() {
        return $this->hasMany(Objective::class,'game_id','id')->where('creator_id','===', auth()->user()->id);
    }

    public function creator() {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }
}
