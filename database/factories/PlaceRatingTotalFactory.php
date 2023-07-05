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

        $place = Place::all()->random();
        $totalRater = PlaceRating::where('place_id', $place->id)->count();
        $averageRating = PlaceRating::where('place_id', $place->id)->avg('rating');

        if (!$averageRating) {
            $averageRating = 0;
        }

        return [
            'id' => $uuid,
            'place_id' => $place->id,
            'average_rating' => $averageRating,
            'total_rater' => $totalRater,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
