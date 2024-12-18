<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserPreference>
 */
class UserPreferenceFactory extends Factory
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
            'metric_system' => fake()->randomElement(['Imperial', 'Metric']),
            'is_notification_enabled' => fake()->randomElement([true, false]),
            'theme' => fake()->randomElement(['Light', 'Dark']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
