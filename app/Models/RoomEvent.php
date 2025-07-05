<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomEvent extends Model
{
    use HasFactory;

    public function events() {
        return $this->hasMany(RoomEvent::class, 'room_id', 'id');
    }
}
