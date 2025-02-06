<?php

namespace App\Jobs;

use App\Models\Subscription;
use App\Notifications\ReminderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class DailyReminder implements ShouldQueue
{
    use Queueable;

    public function __construct(public Subscription $subscription) {}

    public function handle(): void
    {
        $this->subscription->notify(new ReminderNotification);
    }
}
