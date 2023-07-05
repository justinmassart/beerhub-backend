<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\BeerBrand;
use App\Models\BeerPlace;
use App\Models\BeerRating;
use App\Models\PlaceRating;
use Illuminate\Database\Seeder;
use App\Models\BeerRatingTotal;
use App\Models\PlaceRatingTotal;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::factory(100)->create();
        BeerBrand::factory(250)->create();
        BeerPlace::factory(100)->create();
        BeerRating::factory(1000)->create();
        PlaceRating::factory(1000)->create();
        BeerRatingTotal::factory(1000)->create();
        PlaceRatingTotal::factory(1000)->create();
    }
}
