<?php

namespace App\Listeners;

use App\Actions\ShouldNotifyQueueOwner;
use App\Events\OrderUpdatedEvent;
use App\Notifications\TelegramNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class OrderUpdatedListener implements ShouldQueue
{
    use InteractsWithQueue;

    public ?string $connection = 'database';

    public ?string $queue = 'app';

    public int $tries = 3;

    public function handle(OrderUpdatedEvent $event)
    {
        if (app(ShouldNotifyQueueOwner::class)($event->order)) {
            Notification::send($event->order->owner->chats, new TelegramNotification($event->order));
        }
    }
}
