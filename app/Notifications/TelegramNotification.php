<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class TelegramNotification extends Notification
{
    use Queueable;

//    public $connection = 'database';
//
//    public $queue = 'notifications';

    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable): array
    {
        return ['telegram'];
    }

    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->to($notifiable->chat_id)
            ->content("{$notifiable->user->name}! 😈 Your Playstation 5 queue number has changed to *{$this->order->queue}*");
    }

    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
