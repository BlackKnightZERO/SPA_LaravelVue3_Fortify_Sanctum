<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'artist_category_id' => rand(1,2),
            'image' => 'default.png',
            'description' => $this->faker->paragraph(),
            'nationality' => $this->faker->country(),
            'date_of_birth' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'created_at'    => now()
        ];
    }
}
