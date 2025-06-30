<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthParticipant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function participant() {
        return $this->morphOne(Participant::class, "participantable");
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public static function CreateAuthParticipant(User $user) {
        $self = AuthParticipant::create([
            "user_id"=> $user->id,
        ]);
        $self->participant->create();
    }
}