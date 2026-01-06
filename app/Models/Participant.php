<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function participantable() {
        return $this->morphTo();
    }

    public function get_name() {
        if($this->participantable_type == "App\Models\AuthParticipant") {
            return $this->participantable->user->name;
        } else {
            return $this->participantable->username;
        }
    }

    public function team() {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }
}
