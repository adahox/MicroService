<?php

namespace App;

use App\Rabbit\Rabbit;
use App\Rabbit\RabbitConnection;
use DI\ContainerBuilder;

function bootstrap()
{
    $containerBuilder = new ContainerBuilder();

    $containerBuilder->addDefinitions([
        RabbitConnection::class => \DI\create(RabbitConnection::class),
        Rabbit::class => \DI\create(Rabbit::class)->constructor(
            RabbitConnection::class,
        ),
    ]);

    $containerBuilder->build();
}

/**
 * @param string $name
 */
function app(string $name): mixed
{
    $container = new \DI\Container();
    $instance = $container->get($name);

    return $instance;
}

bootstrap();
