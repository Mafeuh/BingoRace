<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BingoGridSquare extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bingogrid() {
        return $this->belongsTo(BingoGrid::class);
    }
}
