<?php

namespace Database\Factories;

use App\Models\Subscription;
use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Subscription>
 */
class SubscriptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'website_id' => Website::factory(),
        ];
    }
}
