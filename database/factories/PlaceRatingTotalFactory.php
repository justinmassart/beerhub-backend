<?php

namespace Database\Factories;

use App\Models\Place;
use App\Models\PlaceRating;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlaceRatingTotal>
 */
class PlaceRatingTotalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $uuid = Str::uuid();

        $totalRater = fake()->numberBetween(1, 15682);
        $averageRating = fake()->randomFloat(1, 1, 5);

        return [
            'id' => $uuid,
            'average_rating' => $averageRating,
            'total_rater' => $totalRater,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
