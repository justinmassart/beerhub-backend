<?php

namespace Database\Factories;

use App\Models\Beer;
use App\Models\Place;
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

        return [
            'id' => $uuid,
            'beer_id' => $beer->id,
            'place_id' => $place->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
