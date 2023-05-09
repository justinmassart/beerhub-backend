<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\BeerBrand;
use App\Models\BeerPlace;
use Illuminate\Database\Seeder;

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
    }
}
