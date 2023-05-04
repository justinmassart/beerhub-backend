<?php

namespace Database\Factories;

use App\Models\Beer;
use App\Models\Brand;
use App\Models\BeerTranslation;
use App\Models\BrandTranslation;
use App\Models\PlaceTranslation;
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

        BeerTranslation::factory()->create(['beer_id' => $beer->id, 'locale' => 'fr', 'is_default_locale' => true]);
        BeerTranslation::factory()->create(['beer_id' => $beer->id, 'locale' => 'en', 'is_default_locale' => false]);
        BrandTranslation::factory()->create(['brand_id' => $brand->id, 'locale' => 'fr', 'is_default_locale' => true]);
        BrandTranslation::factory()->create(['brand_id' => $brand->id, 'locale' => 'en', 'is_default_locale' => false]);

        return [
            'id' => $uuid,
            'beer_id' => $beer->id,
            'brand_id' => $brand->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
