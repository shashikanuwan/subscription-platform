<?php

namespace App\Console\Commands;

use App\Jobs\DailyReminder;
use App\Models\Subscription;
use Illuminate\Console\Command;

class SendReminderEmailsCommand extends Command
{
    protected $signature = 'app:send-emails';

    protected $description = 'Send daily reminder mail';

    public function handle(): void
    {
        $subscribers = Subscription::query()->get();

        foreach ($subscribers as $subscriber) {
            DailyReminder::dispatch($subscriber);
        }
    }
}
