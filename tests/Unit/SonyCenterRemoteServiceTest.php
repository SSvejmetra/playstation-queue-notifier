<?php

namespace Tests\Unit;

use App\Services\SonyCenterRemoteService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SonyCenterRemoteServiceTest extends TestCase
{
    /** @test */
    public function it_returns_queue_number_if_valid_order_provided()
    {
        $queueNumberFromRemote = 123;

        Http::fake([
            config('services.sony-center.url') . '/APP/item_queue/3313/json' => Http::response($queueNumberFromRemote),
        ]);

        $service = app(SonyCenterRemoteService::class);

        $this->assertEquals($queueNumberFromRemote, $service->getQueue(444));
    }
}
