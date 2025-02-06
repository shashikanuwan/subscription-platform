<?php

namespace App\Actions\Subscription;

use App\Exceptions\SubscriptionAlreadyExistsException;
use App\Models\Subscription;
use App\Models\Website;

class CreateSubscription
{
    /**
     * @throws SubscriptionAlreadyExistsException
     */
    public function execute(
        string $email,
        Website $website,
    ): Subscription {
        $this->ensureEmailIsNotSubscribed($email, $website);

        $subscription = new Subscription;
        $subscription->email = $email;
        $subscription->website()->associate($website);
        $subscription->save();

        return $subscription;
    }

    /**
     * @throws SubscriptionAlreadyExistsException
     */
    private function ensureEmailIsNotSubscribed(string $email, Website $website): void
    {
        if ($this->isEmailAlreadySubscribedToWebsite($email, $website)) {
            throw new SubscriptionAlreadyExistsException($email);
        }
    }

    private function isEmailAlreadySubscribedToWebsite(string $email, Website $website): bool
    {
        return Subscription::query()
            ->where('email', $email)
            ->where('website_id', $website->id)
            ->exists();
    }
}
