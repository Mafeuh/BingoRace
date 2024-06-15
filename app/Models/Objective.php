<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function GeneratePublicObjectives() {
        foreach(Game::all() as $game) {
            for($i = 0; $i < 10; $i++) {
                $pub = PublicObjective::create([]);
                $pub->objective()->create([
                    'game_id' => $game->id,
                    'description' => $game->name . $i
                ]);
            }
        }
    }

    public function game() {
        return $this->belongsTo(Game::class, 'id', 'game_id');
    }

    public function objectiveable() {
        return $this->morphTo();
    }
}
