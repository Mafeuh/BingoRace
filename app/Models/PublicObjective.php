<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicObjective extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function objective() {
        return $this->morphOne(Objective::class, "objectiveable");
    }
}
