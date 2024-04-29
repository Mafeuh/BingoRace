<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateObjective extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function objective() {
        return $this->morphOne(Objective::class, "objectiveable");
    }

    public static function createObjective(string $description, int $game_id) {
        $private = PrivateObjective::create(['user_id' => auth()->user()->id]);

        $private->objective()->create(['description' => $description,'game_id'=> $game_id]);
    }
}
