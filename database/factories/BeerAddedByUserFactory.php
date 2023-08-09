<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BeerAddedByUser>
 */
class BeerAddedByUserFactory extends Factory
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
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
