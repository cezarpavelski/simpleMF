<?php

namespace Framework\Broadcast;

use Predis\Client as PredisClient;

class RedisBroadcaster
{

    private $broadcaster;

    public function __construct()
    {
        $this->broadcaster = new PredisClient(
            $this->getOptions()
        );
    }

    public function publish(string $channel, array $payload): void
    {
        try {
            $this->broadcaster->publish($channel, json_encode($payload));
        } catch (\Exception $e) {
            echo $e->getMessage();exit;
        }

    }

    private function getOptions(): array
    {
        $options = [
            "scheme" => 'tcp',
            "host" => getenv('REDIS_HOST'),
            "port" => getenv('REDIS_PORT')
        ];
        if(getenv('REDIS_PASSWORD') && strtoupper(getenv('REDIS_PASSWORD')) != 'NULL') {
            $options = array_merge($options, ['password'=>getenv('REDIS_PASSWORD')]);
        }
        return $options;
    }

}
