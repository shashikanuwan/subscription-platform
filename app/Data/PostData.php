<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class PostData extends Data
{
    public function __construct(
        #[Required, Max(20), Min(5)]
        public string $title,
        #[Max(20), Min(1)]
        public string $description,
        #[Exists('websites', 'id')]
        public int $websiteId
    ) {}
}
