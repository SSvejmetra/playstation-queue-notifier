<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;

class OrderUpdatedEvent
{
    use Dispatchable, InteractsWithSockets;

    public Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}
