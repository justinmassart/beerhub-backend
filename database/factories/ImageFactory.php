<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $uuid = Str::uuid();

        return [
            'id' => $uuid,
            'url' => fake()->imageUrl(480, 640, 'beers', true, null, true),
            'added_by_user_id' => User::all()->random(),
            'created_at' => now(),
            'updated_at' => now(),
            //
        ];
    }
}
