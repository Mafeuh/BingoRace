<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function participants() {
        return $this->hasMany(Participant::class, 'team_id', 'id');
    }

    public function checked_objectives() {
        return $this->belongsToMany(BingoGridSquare::class, 'checked_bies', 'team_id', 'square_id');
    }
}
