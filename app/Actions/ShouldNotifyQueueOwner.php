<?php

namespace App\Actions;

use App\Models\Order;

class ShouldNotifyQueueOwner
{
    public function __invoke(Order $order): bool
    {
        if (!$order->wasChanged('queue')) {
            return false;
        }

        if (!$order->queue) {
            return false;
        }

        return true;
    }
}
