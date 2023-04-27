<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $uuid = Str::uuid();
        return [
            'id' => $uuid,
            'name' => fake()->company(),
            'address' => fake()->address(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'country' => fake()->countryCode(),
            'type' => fake()->randomElement(['abbey', 'brewer', 'wholesaler', 'cafe', 'merchant']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
