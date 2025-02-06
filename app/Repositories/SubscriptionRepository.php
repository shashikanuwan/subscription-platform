<?php

namespace App\Repositories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Collection;

class SubscriptionRepository
{
    public function getByWebsiteId(int $websiteId): Collection
    {
        return Subscription::query()
            ->where('website_id', $websiteId)
            ->get();
    }
}
