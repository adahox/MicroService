<?php

namespace App\Trait\Queue;

use App\Facades\Rabbit;

trait Queueable
{
    public static function dispatch(mixed $payload): self
    {
        $queueName = basename(str_replace("\\", "/", static::class));

        $static = new static($payload);

        $body = json_encode([
            "job" => static::class,
            "method" => "handle",
            "payload" => $payload,
        ]);

        Rabbit::publish($queueName, $body);

        return $static;
    }

    public function onQueue(string $queueName): void
    {
        #
    }
}
