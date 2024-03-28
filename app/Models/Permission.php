<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function GeneratePermissions() {
        $permissions = [
            'admin' => 'Administrateurice',
            'make_game_public' => 'Rendre un jeu public',
            'make_objective_public_on_public_game' => 'Rendre public un objectif de jeu public',
            'delete_public_game' => 'Supprimer un jeu public',
            'delete_user_account' => 'Supprimer un compte utilisateur',
        ]
    }
}
