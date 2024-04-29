<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function GeneratePublicObjectives() {
        for ($i = 1; $i <= 50; $i++) {
            $public = PublicObjective::create([]);

            $public->objective()->create([
                'description' => 'Objectif N°'. $i,
                'game_id'=> 1,
            ]);
        }
    }

    public function game() {
        return $this->belongsTo(Game::class, 'id', 'game_id');
    }

    public function objectiveable() {
        return $this->morphTo();
    }
}
