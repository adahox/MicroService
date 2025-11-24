<?php

namespace App\Rabbit;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Rabbit
{
    public static function publish(
        string $queueName,
        string $serializedJob,
    ): void {
        # Conecta no rabbitMQ
        $connection = new AMQPStreamConnection(
            "172.25.129.244",
            5672,
            "admin",
            "admin",
        );
        $channel = $connection->channel();
        # Implementa a Fila
        $channel->queue_declare($queueName, false, false, false, false);
        # Prepara a Msg
        $msg = new AMQPMessage($serializedJob);
        # Joga na Fila
        $channel->basic_publish($msg, "", $queueName);
        # Fecha as conexões
        $channel->close();
        $connection->close();
    }

    public static function subscribe(string $queueName = "UnfollowJob"): void
    {
        # code.
        $connection = new AMQPStreamConnection(
            "172.25.129.244",
            5672,
            "admin",
            "admin",
        );

        $channel = $connection->channel();

        $channel->basic_consume(
            $queueName,
            "",
            false,
            true,
            false,
            false,
            null, # callback
        );

        try {
            $channel->consume();
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }
    }
}
