<?php

namespace App\Console\Commands;

use App\Jobs\CheckOrderStatusJob;
use App\Models\Order;
use Illuminate\Console\Command;

class CheckQueueStatus extends Command
{
    protected $signature = 'playstation:check-queue-status';

    protected $description = 'Checks and updates queue statuses for orders';

    public function handle(): int
    {
        $orders = Order::query()->cursor();

        foreach ($orders as $order) {
            CheckOrderStatusJob::dispatch($order)
                ->onConnection('database')
                ->onQueue('playstation');
        }

        return Command::SUCCESS;
    }
}
