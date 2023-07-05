<?php

namespace Database\Factories;

use App\Models\Beer;
use App\Models\BeerRating;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BeerRatingTotal>
 */
class BeerRatingTotalFactory extends Factory
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
        $totalRater = BeerRating::where('beer_id', $beer->id)->count();
        $averageRating = BeerRating::where('beer_id', $beer->id)->avg('rating');

        if (!$averageRating) {
            $averageRating = 0;
        }

        return [
            'id' => $uuid,
            'beer_id' => $beer->id,
            'average_rating' => $averageRating,
            'total_rater' => $totalRater,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
