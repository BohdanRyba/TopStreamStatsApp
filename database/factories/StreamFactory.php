<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stream>
 */
class StreamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => fake()->ean13(),
            'user_id' => fake()->ean8(),
            'user_login' => fake()->name(),
            'user_name' => fake()->name(),
            'game_id' => fake()->numberBetween(1, 10000),
            'game_name' => fake()->company(),
            'type' => "live",
            'title' => fake()->sentence(),
            'viewer_count' => fake()->numberBetween(10, 100000),
            'started_at' => now(),
            'language' => fake()->languageCode(),
            'thumbnail_url' => fake()->imageUrl(),
            'is_mature' => fake()->boolean(70),
        ];
    }
}
