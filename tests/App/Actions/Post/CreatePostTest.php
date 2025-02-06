<?php

use App\Actions\Post\CreatePost;
use App\Events\PostPublished;
use App\Exceptions\PostTitleAlreadyExistException;
use App\Models\Post;
use App\Models\Website;
use Illuminate\Support\Facades\Event;

it('can create post', function () {
    Event::fake();
    /** @var Website $website */
    $website = Website::factory()->create();

    $post = resolve(CreatePost::class)
        ->execute(
            'This is a post title',
            'This is a post description',
            $website
        );

    expect($post)
        ->toBeInstanceOf(Post::class)
        ->and($post->title)->toBe('This is a post title')
        ->and($post->description)->toBe('This is a post description')
        ->and($post->website_id)->toBe($website->id);
});

test('can dispatches PostPublished event after creating a post', function () {
    Event::fake();
    /** @var Website $website */
    $website = Website::factory()->create();

    $post = resolve(CreatePost::class)
        ->execute(
            'Test Title',
            'Test Description',
            $website
        );

    Event::assertDispatched(PostPublished::class, function ($event) use ($post) {
        return $event->post->id === $post->id;
    });
});

test('throws exception if title already exists', function () {
    /** @var Website $website */
    $website = Website::factory()->create();

    Post::factory()->create([
        'title' => 'Existing Title',
        'website_id' => $website->id,
    ]);

    resolve(CreatePost::class)
        ->execute(
            'Existing Title',
            'This is a post description',
            $website
        );
})->throws(PostTitleAlreadyExistException::class);
