<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnonymousParticipant extends Model
{
    use HasFactory;

    public function participant() {
        return $this->morphOne(Participant::class, "participantable");
    }

    public static function CreateAnonymousParticipant(string $username) {
        $self = AnonymousParticipant::create([
            "username"=> $username
        ]);

        $self->participant()->create();
    }
}
