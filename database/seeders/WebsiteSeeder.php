<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Subscription;
use App\Models\Website;
use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    public function run(): void
    {
        Website::factory(5)
            ->has(Post::factory(3))
            ->has(Subscription::factory(3))
            ->create();
    }
}
