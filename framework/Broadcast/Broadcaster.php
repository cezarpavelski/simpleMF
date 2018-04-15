<?php

namespace Framework\Broadcast;

use Framework\Broadcast\RedisBroadcaster;
use Framework\Broadcast\IBroadcast;

class Broadcaster implements IBroadcast
{

    public static function publish(string $channel, array $payload): void
    {
        $broadcaster = new RedisBroadcaster();
        $broadcaster->publish($channel, $payload);
    }

}
