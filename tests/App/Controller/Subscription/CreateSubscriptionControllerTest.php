<?php

use App\Models\Subscription;
use App\Models\Website;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\postJson;

it('requires email field', function () {
    $response = postJson(route('subscriptions.store'), [
        'website_id' => 1,
    ]);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    $response->assertJsonValidationErrors(['email']);
});

it('must be a valid email address', function () {
    $response = postJson(route('subscriptions.store'), [
        'email' => 'email',
        'website_id' => 1,
    ]);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    $response->assertJsonValidationErrors(['email']);
});

it('requires website_id field', function () {
    $response = postJson(route('posts.store'), [
        'title' => 'This is a post title',
        'description' => 'This is a post description',
    ]);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    $response->assertJsonValidationErrors(['website_id']);
});

it('validates website_id must exist in the websites table', function () {
    $response = postJson(route('posts.store'), [
        'title' => 'Valid Post Title',
        'description' => 'This is a post description',
        'website_id' => 999,
    ]);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    $response->assertJsonValidationErrors(['website_id']);
});

it('can create subscription', function () {
    /** @var Website $website */
    $website = Website::factory()->create();

    /** @var Subscription $subscription */
    $response = postJson(route('subscriptions.store'), [
        'email' => 'test@test.com',
        'website_id' => $website->id,
    ]);

    $response->assertStatus(Response::HTTP_CREATED);
    $response->assertJson(['message' => 'Subscribed']);
});
