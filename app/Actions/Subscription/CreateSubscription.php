<?php

namespace App\Actions\Subscription;

use App\Exceptions\SubscriptionAlreadyExistsException;
use App\Models\Subscription;
use App\Models\Website;
use App\Repositories\SubscriptionRepository;

class CreateSubscription
{
    public function __construct(protected SubscriptionRepository $subscriptionRepository) {}

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
        return $this->subscriptionRepository->isEmailSubscribed($email, $website->id);
    }
}
