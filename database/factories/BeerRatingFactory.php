<?php

namespace Database\Factories;

use App\Models\Beer;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BeerRating>
 */
class BeerRatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $uuid = Str::uuid();

        $beer = Beer::all()->random();
        $user = User::all()->random();

        return [
            'id' => $uuid,
            'user_id' => $user->id,
            'beer_id' => $beer->id,
            'rating' => fake()->numberBetween(1, 5),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
