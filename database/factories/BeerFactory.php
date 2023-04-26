<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        $country = fake()->country();
        return [
            'name' => fake()->word(),
            'type' => fake()->randomElement(['Blond', 'Amber', 'Black', 'Brown', 'White', 'Fruity', 'IPA', 'Stout']),
            'country' => $country,
            'volume_available' => json_encode('30'),
            'container_available' => json_encode('bottle'),
            'description' => fake()->paragraphs(3, true),
            'aromas' => ['apple'],
            'ingredients' => ['apple', 'water', 'hop'],
            'color' => fake()->randomElement(['White', 'Black', 'Brown', 'Amber', 'Red', 'Blond', 'Blue']),
            'abv' => fake()->randomFloat(1, 0, 16),
            'ibu' => fake()->randomFloat(1, 0, 54),
            'is_from_abbey' => ($country === 'Belgium' || $country === 'Austria' ? fake()->randomElement([true, false]) : false),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
