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
            $room->code = static::generateUniqueCode();
        });
    }

    protected static function codeExists($code)
    {
        return static::where('code', $code)->exists();
    }
    
    private static function generateUniqueCode() {
        do {
            $code = static::generateCode();
        } while (static::codeExists($code));

        return $code;
    }

    private static function generateCode($length = 5) {
        return substr(str_shuffle(str_repeat('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ')))), 1, $length);
    }

    public function teams() {
        return $this->hasMany(Team::class, 'room_id', 'id');
    }

    public function grid() {
        return $this->hasOne(BingoGrid::class, 'room_id', 'id');
    }
}
