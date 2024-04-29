<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BingoGrid extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function squares() {
        return $this->hasMany(BingoGridSquare::class);
    }

    public function room() {
        return $this->belongsTo(Room::class);
    }
}
