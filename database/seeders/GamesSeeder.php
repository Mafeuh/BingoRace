<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\PrivateObjective;
use App\Models\PublicObjective;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $games = Game::factory(100)->create();

        foreach($games as $game) {
            for($i = 0; $i < 100; $i++) {
                $pub = PublicObjective::create();
                $pub->objective()->create([
                    'description' => fake()->sentence,
                    'game_id' => $game->id,
                ]);

                $priv = PrivateObjective::create([
                    'user_id' => 1
                ]);
                $priv->objective()->create([
                    'description' => fake()->sentence,
                    'game_id' => $game->id
                ]);
            }
        }
    }
}
