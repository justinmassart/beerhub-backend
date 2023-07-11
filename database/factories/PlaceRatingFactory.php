<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Place;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlaceRating>
 */
class PlaceRatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $uuid = Str::uuid();

        $place = Place::all()->random();
        $user = User::all()->random();

        return [
            'id' => $uuid,
            'user_id' => $user->id,
            'place_id' => $place->id,
            'rating' => fake()->numberBetween(1, 5),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
