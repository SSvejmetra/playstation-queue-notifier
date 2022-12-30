<?php

namespace App\Services;

use App\Services\Exceptions\SonyCenterRemoteServiceException;
use Illuminate\Support\Facades\Http;

class SonyCenterRemoteService
{
    public function getQueue(int $orderId): int
    {
        $response = Http::baseUrl(config('services.sony-center.url'))
            ->asMultipart()
            ->post('APP/item_queue/3313/json', [
                'order_id' => $orderId
            ]);

        throw_unless(
            $response->ok(),
            SonyCenterRemoteServiceException::class,
            "Bad call for order $orderId"
        );

        return (int)$response->json();
    }
}
