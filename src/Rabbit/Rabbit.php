<?php

namespace App\Rabbit;

use App\Rabbit\RabbitConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Rabbit
{
    public function __construct(private RabbitConnection $connection)
    {
        #
    }

    public function publish(string $queueName, string $serializedJob): void
    {
        $channel = $this->connection->channel();
        $channel->queue_declare($queueName, false, false, false, false);
        $msg = new AMQPMessage($serializedJob);
        $channel->basic_publish($msg, "", $queueName);
        $channel->close();
        $this->connection->close();
    }

    public function subscribe(string $queueName): void
    {
        $channel = $this->connection->channel();

        $channel->basic_consume(
            $queueName,
            "",
            false,
            true,
            false,
            false,
            function (AMQPMessage $msg) {
                $data = json_decode($msg->getBody(), true);

                $jobClass = $data["job"];
                $method = $data["method"];
                $payload = (object) $data["payload"];

                /** @var object $job */
                $job = new $jobClass($payload);

                // Chama o método configurado
                echo "Executado {$jobClass}::{$method}\r\n";
                $job->$method($payload);
            },
        );

        try {
            $channel->consume();
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }

        $this->connection->close();
    }
}
