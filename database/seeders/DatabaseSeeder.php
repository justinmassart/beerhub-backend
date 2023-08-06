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
use App\Models\User;
use App\Models\UserPreference;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::factory(50)->create();
        BeerBrand::factory(100)->create();
        BeerPlace::factory(100)->create();
        BeerRating::factory(250)->create();
        PlaceRating::factory(250)->create();

        $user = User::create([
            'firstname' => 'Justin',
            'lastname' => 'Massart',
            'username' => 'TheDev',
            'email' => 'justinmassart@outlook.com',
            'phone' => '+32494391109',
            'phone_verified_at' => now(),
            'password' => bcrypt('password'),
            'DOB' => '2000-11-09',
            'country' => 'BE',
            'user_preferences_id' => UserPreference::factory()->create()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Role::create([
            'access_rights' => 'user',
            'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
