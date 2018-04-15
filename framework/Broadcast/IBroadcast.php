<?php

namespace Framework\Broadcast;

interface IBroadcast
{
    public function publish(string $channel, array $payload): void;

}
