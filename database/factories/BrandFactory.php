<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $uuid = Str::uuid();
        $name = fake()->company() . ' ' . fake()->word();
        return [
            'id' => $uuid,
            'name' => $name,
            'slogan' => fake()->catchPhrase(),
            'address' => fake()->address(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'creation_date' => fake()->numberBetween(700, date('Y')),
            'country' => fake()->countryCode(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
