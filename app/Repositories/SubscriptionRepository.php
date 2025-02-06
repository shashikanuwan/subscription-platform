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

    public function isEmailSubscribed(string $email, int $websiteId): bool
    {
        return Subscription::query()
            ->where('email', $email)
            ->where('website_id', $websiteId)
            ->exists();
    }
}
