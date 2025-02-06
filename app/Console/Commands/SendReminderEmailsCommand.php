<?php

namespace App\Console\Commands;

use App\Jobs\DailyReminder;
use App\Repositories\SubscriptionRepository;
use Illuminate\Console\Command;

class SendReminderEmailsCommand extends Command
{
    protected $signature = 'app:send-reminder-emails';

    protected $description = 'Send daily reminder mail';

    public function __construct(protected SubscriptionRepository $subscriptionRepository)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $subscribers = $this->subscriptionRepository->all();

        foreach ($subscribers as $subscriber) {
            DailyReminder::dispatch($subscriber);
        }
    }
}
