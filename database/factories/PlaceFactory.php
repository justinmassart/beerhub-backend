<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'address' => fake()->address(),
            'country' => fake()->country(),
            'type' => fake()->randomElement(['abbey', 'brewer', 'wholesaler', 'cafe', 'merchant']),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
