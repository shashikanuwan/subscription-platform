<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Notifications\ReminderNotification;
use Illuminate\Console\Command;

class SendEmailsCommand extends Command
{
    protected $signature = 'app:send-emails';

    protected $description = 'Send reminder';

    public function handle(): void
    {
        $subscribers = Subscription::query()->get();

        foreach ($subscribers as $subscriber) {
            $subscriber->notify(new ReminderNotification);
        }
    }
}
