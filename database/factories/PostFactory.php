<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->word(),
            'description' => fake()->text(),
            'website_id' => Website::factory(),
        ];
    }
}
