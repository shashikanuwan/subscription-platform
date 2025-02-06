<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostPublishedNotification extends Notification
{
    use Queueable;

    public function __construct(public Post $post) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Post Published!')
            ->greeting('Hello,')
            ->line('A new post has just been published.')
            ->line('**Post Title:** '.$this->post->title)
            ->line('**Post Description:** '.$this->post->description)
            ->line('Thank you for staying updated with us!');
    }
}
