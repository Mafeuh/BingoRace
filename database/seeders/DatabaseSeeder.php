<?php

namespace Database\Seeders;

use App\Models\Objective;
use App\Models\Room;
use App\Models\User;
use App\Models\Game;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Game::GeneratePublicGames();
        Objective::GeneratePublicObjectives();

        User::factory(10)->create();
        $moi = User::create([
            'name' => 'Mafeuh',
            'email' => 'leomafille.pro@gmail.com',
            'password' => bcrypt('pass'),
        ]);
    }
}
