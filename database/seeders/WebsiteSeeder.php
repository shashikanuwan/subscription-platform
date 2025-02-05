<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    public function run(): void
    {
        Website::factory(5)->create();
    }
}
