<?php

namespace Database\Factories;

use App\Models\Beer;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BeerBrand>
 */
class BeerBrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $uuid = Str::uuid();

        $brand = Brand::factory()->create();
        $beer = Beer::factory()->create();

        return [
            'id' => $uuid,
            'beer_id' => $beer->id,
            'brand_id' => $brand->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
