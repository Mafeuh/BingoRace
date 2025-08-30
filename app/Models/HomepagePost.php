<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;

class HomepagePost extends Model
{
    protected $guarded = [];

    public function translations() {
        return $this->hasMany(HomepagePostTranslations::class, 'post_id', 'id');
    }
}
