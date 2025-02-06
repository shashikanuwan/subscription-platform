<?php

use App\Actions\Subscription\CreateSubscription;
use App\Exceptions\SubscriptionAlreadyExistsException;
use App\Models\Subscription;
use App\Models\Website;

it('throws exception if subscription already exists', function () {
    /** @var Website $website */
    $website = Website::factory()->create();

    Subscription::factory()
        ->create([
            'email' => 'test@test.com',
            'website_id' => $website->id,
        ]);

    resolve(CreateSubscription::class)
        ->execute(
            'test@test.com',
            $website
        );
})->throws(SubscriptionAlreadyExistsException::class);

it('can create subscription', function () {
    /** @var Website $website */
    $website = Website::factory()->create();

    $subscription = resolve(CreateSubscription::class)
        ->execute(
            'test@test.com',
            $website
        );

    expect($subscription)
        ->toBeInstanceOf(Subscription::class)
        ->and($subscription->email)->toBe('test@test.com')
        ->and($subscription->website_id)->toBe($website->id);
});
