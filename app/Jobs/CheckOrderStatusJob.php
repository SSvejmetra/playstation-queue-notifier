<?php

namespace App\Jobs;

use App\Models\Order;
use App\Services\SonyCenterRemoteService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckOrderStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        $service = app(SonyCenterRemoteService::class);

        $queue = $service->getQueue($this->order->external_id);

        $this->order->update([
            'queue' => $queue
        ]);
    }
}
