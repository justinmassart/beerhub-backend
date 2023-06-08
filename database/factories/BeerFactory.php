<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Beer>
 */
class BeerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $uuid = Str::uuid();
        $country = fake()->countryCode();
        $uuid = Str::uuid();
        return [
            'id' => $uuid,
            'name' => fake()->word(),
            'type' => fake()->randomElement(['Blond', 'Amber', 'Black', 'Brown', 'White', 'Fruity', 'IPA', 'Stout']),
            'country' => $country,
            'volume_available' => json_encode(['25cl', '30cl', '75cl', '1L', '1.5L', '2L']),
            'container_available' => json_encode(['bottle', 'can', 'barrel']),
            'aromas' => json_encode(['apple', 'vanilla', 'caramel']),
            'ingredients' => json_encode(['apple', 'water', 'hop']),
            'color' => fake()->randomElement(['White', 'Black', 'Brown', 'Amber', 'Red', 'Blond', 'Blue']),
            'abv' => fake()->randomFloat(1, 0, 16),
            'ibu' => fake()->randomFloat(1, 0, 54),
            'is_gluten_free' => fake()->numberBetween(0, 1),
            'is_from_abbey' => ($country === 'Belgium' || $country === 'Austria' ? fake()->randomElement([true, false]) : false),
            'non_filtered' => fake()->numberBetween(0, 1),
            'refermented' => fake()->numberBetween(0, 1),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
