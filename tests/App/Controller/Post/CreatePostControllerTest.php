<?php

use App\Actions\Post\CreatePost;
use App\Models\Website;
use Illuminate\Support\Facades\Event;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\postJson;

it('requires title field', function () {
    $response = postJson(route('posts.store'), [
        'description' => 'This is a post description',
        'website_id' => 1,
    ]);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    $response->assertJsonValidationErrors(['title']);
});

it('requires description field', function () {
    $response = postJson(route('posts.store'), [
        'title' => 'This is a post title',
        'website_id' => 1,
    ]);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    $response->assertJsonValidationErrors(['description']);
});

it('requires website_id field', function () {
    $response = postJson(route('posts.store'), [
        'title' => 'This is a post title',
        'description' => 'This is a post description',
    ]);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    $response->assertJsonValidationErrors(['website_id']);
});

it('validates title length is at least 5 characters', function () {
    $response = postJson(route('posts.store'), [
        'title' => 'Test',
        'description' => 'This is a post description',
        'website_id' => 1,
    ]);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    $response->assertJsonValidationErrors(['title']);
});

it('validates title length does not exceed 50 characters', function () {
    $response = postJson(route('posts.store'), [
        'title' => str_repeat('a', 51),
        'description' => 'This is a post description',
        'website_id' => 1,
    ]);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    $response->assertJsonValidationErrors(['title']);
});

it('validates description does not exceed 255 characters', function () {
    $response = postJson(route('posts.store'), [
        'title' => 'Valid Post Title',
        'description' => str_repeat('a', 256),
        'website_id' => 1,
    ]);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    $response->assertJsonValidationErrors(['description']);
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

it('can create a new post', function () {
    Event::fake();
    $website = Website::factory()->create();

    mock(CreatePost::class)
        ->shouldReceive('execute');

    $response = postJson(route('posts.store'), [
        'title' => 'This is a post title',
        'description' => 'This is a post description',
        'website_id' => $website->id,
    ]);

    $response->assertStatus(Response::HTTP_CREATED);
    $response->assertJson(['message' => 'Post saved']);
});
