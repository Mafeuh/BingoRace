<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function moderated_games() {
        return $this->hasManyThrough(Game::class, GameModerator::class);
    }

    public function participations() {
        return $this->hasMany(AuthParticipant::class, 'user_id', 'id');
    }

    public function permissions() {
        return $this->hasMany(UserPermission::class, 'user_id', 'id');
    }

    public function hasPermission(string $slug) {
        foreach($this->permissions()->get() as $permission) {
            if ($permission->permission->slug == $slug) {
                return true;
            }
        }
        return false;
    }

    public function isAdmin() {
        return $this->hasPermission('admin');
    }
}
