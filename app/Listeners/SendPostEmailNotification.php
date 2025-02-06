<?php

namespace App\Listeners;

use App\Events\PostPublished;
use App\Notifications\PostPublishedNotification;
use App\Repositories\SubscriptionRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendPostEmailNotification implements ShouldQueue
{
    use Queueable;

    public function __construct(protected SubscriptionRepository $subscriptionRepository) {}

    public function handle(PostPublished $event): void
    {
        $post = $event->post;
        $subscribers = $this->subscriptionRepository->getByWebsiteId($post->website_id);

        Notification::send($subscribers, new PostPublishedNotification($post));
    }
}
