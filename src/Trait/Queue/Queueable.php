<?php

namespace App\Trait\Queue;

use App\Rabbit\Rabbit;

trait Queueable
{
    public static function dispatch(mixed $payload): self
    {
        $job = new static($payload);

        $job->handle();

        $queueName = basename(str_replace("\\", "/", static::class));

        $serialized = serialize($job);

        Rabbit::publish($queueName, $serialized);

        return $job;
    }

    public function onQueue(string $channel): void
    {
        # TODO: Implement after
    }
}
