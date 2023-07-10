<?php

namespace Database\Factories;

use App\Models\Beer;
use App\Models\Place;
use App\Models\Image;
use App\Models\PlaceImage;
use App\Models\PlaceRatingTotal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BeerPlace>
 */
class BeerPlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $uuid = Str::uuid();

        $place = Place::factory()->create();
        $beer = Beer::all()->random();

        $placeImage = Image::factory()->create();
        PlaceImage::factory()->create(['place_id' => $beer->id, 'image_id' => $placeImage->id]);

        PlaceRatingTotal::factory()->create(['place_id' => $place->id]);

        return [
            'id' => $uuid,
            'beer_id' => $beer->id,
            'place_id' => $place->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
