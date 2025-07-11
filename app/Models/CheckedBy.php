<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckedBy extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function team() {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }
    public function square() {
        return $this->hasOne(BingoGridSquare::class, 'id', 'square_id');
    }
}
