<?php
namespace App\Services;


use App\Events\AdminEvent;
use App\Events\OfferStatus;
use App\Events\UserEvent;


class DispatchService
{
    public static function AdminChannelSend($data)
    {
        AdminEvent::dispatch($data);

    }
    public static function createResponse($type, $data)
    {
        $response = [
            'type' => $type,
            'data' => $data,
        ];

        return $response;
    }
}
