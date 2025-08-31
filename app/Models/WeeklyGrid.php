<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklyGrid extends Model
{
    public function grid() {
        return $this->hasOne(BingoGrid::class, 'id', 'grid_id');
    }
}
