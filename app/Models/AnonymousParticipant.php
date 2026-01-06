<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnonymousParticipant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function participant() {
        return $this->morphOne(Participant::class, "participantable");
    }
}
