<?php
namespace App\Services;


use App\Events\AdminEvent;
use App\Events\OfferStatus;
use App\Events\UserEvent;

use App\Models\User;


class DispatchService
{
    public static function AdminChannelSend($data)
    {
        AdminEvent::dispatch($data);

    }
    public static function UserChannelSend($userId, $data)
    {
        event(new \App\Events\UserEvent(User::find($userId), $data));

    }
    public static function OfferStatusChannelSend($data)
    {
        OfferStatus::dispatch($data);

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
