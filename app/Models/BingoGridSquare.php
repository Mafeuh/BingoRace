<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BingoGridSquare extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function objective() {
        return $this->hasOne(Objective::class, 'id', 'objective_id');
    }

    public function grid() {
        return $this->hasOne(BingoGrid::class, 'id', 'grid_id');
    }

    public function checked_by() {
        return $this->hasOne(Team::class, 'id', 'checked_by_team_id');
    }
}
