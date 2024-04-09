<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot() {
        parent::boot();

        static::creating(function ($room) {
            $schema = '';
            for ($i = 0; $i < 5; $i++) {
                $schema .= fake()->randomKey(['#' => [], '?' => []]);
            }

            $room->code = strtoupper(fake()->unique()->bothify($schema));
        });
    }

    public function teams() {
        return $this->hasMany(Team::class, 'room_id', 'id');
    }
}
