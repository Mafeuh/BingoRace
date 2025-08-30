<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;

class HomepagePost extends Model
{
    protected $guarded = [];

    public function author() {
        return $this->belongsTo(User::class);
    }
}
