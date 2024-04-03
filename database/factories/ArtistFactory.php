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
    public function definition(): array
    {
        return [
            'mbid' => $this->faker->uuid,
            'name' => $this->faker->name,
            'image' => $this->faker->imageUrl(),
            'listeners' => $this->faker->numberBetween(1000, 1000000),
            'saved_by_user' => $this->faker->randomNumber()
        ];
    }
}
