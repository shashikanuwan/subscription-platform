<?php

namespace App\Listeners;

use App\Events\PostPublished;
use App\Models\Subscription;
use App\Notifications\PostPublishedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPostEmailNotification implements ShouldQueue
{
    public function __construct() {}

    public function handle(PostPublished $event): void
    {
        $post = $event->post;

        $subscribers = Subscription::query()
            ->where('website_id', $post->website_id);

        foreach ($subscribers as $subscriber) {
            $subscriber->notify(new PostPublishedNotification($post));
        }
    }
}
