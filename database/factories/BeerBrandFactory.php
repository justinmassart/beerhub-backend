<?php

namespace Database\Factories;

use App\Models\Beer;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

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

        $brand = Brand::factory()->create();

        return [
            'beer_id' => Beer::factory()->create(['brand_id' => $brand->id])->id,
            'brand_id' => $brand->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        /*         return [
            'beer_id' => Beer::factory()->create()->id,
            'brand_id' => Brand::factory()->create()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]; */
    }
}
