<?php

use App\Models\Website;

use function Pest\Laravel\post;

it('can create post', function () {
    $website = Website::factory()->create();

  post('/test', [
        'title' => 'fefe',
        'description' => 'fefef',
        'website_id' => 2,
    ]);

});
