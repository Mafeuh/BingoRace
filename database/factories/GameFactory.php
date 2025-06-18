<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $is_official = random_int(0, 1) == 0;
        $is_public = random_int(0, 1) == 0;

        return [
            'name' => $this->faker->word." ".($is_official ? 'o' : '')." ".($is_public ? 'p' : ''),
            'is_official' => $is_official,
            'is_public' => $is_public,
            'image_url' => ''
        ];
    }
}
