<?php

namespace Framework\Broadcast;

use Framework\Broadcast\RedisBroadcaster;

class Broadcaster
{

    public static function publish(string $channel, array $payload): void
    {
        $broadcaster = new RedisBroadcaster();
        $broadcaster->publish($channel, $payload);
    }

}
