<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function GeneratePublicObjectives() {
        for ($i = 0; $i < 50; $i++) {
            Objective::create([
                'description' => "Objectif n°$i",
                'game_id' => 1,
            ]);
        }
    }

    public function game() {
        return $this->belongsTo(Game::class, 'id', 'game_id');
    }
}
