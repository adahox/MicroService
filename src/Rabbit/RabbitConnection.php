<?php

namespace App\Rabbit;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitConnection
{
    private AMQPStreamConnection $connection;
    private AMQPChannel $channel;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection(
            "172.25.129.244",
            5672,
            "admin",
            "admin",
        );

        $this->channel = $this->connection->channel();
    }

    public function connection(): AMQPStreamConnection
    {
        return $this->connection;
    }

    public function channel(): AMQPChannel
    {
        return $this->channel;
    }

    public function close(): void
    {
        $this->channel->close();
        $this->connection->close();
    }
}
