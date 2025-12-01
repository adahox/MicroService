<?php

namespace App;

use App\Rabbit\Rabbit;
use App\Rabbit\RabbitConnection;
use DI\ContainerBuilder;

// Armazena a instância do container construída no bootstrap.
$container = null;

function bootstrap()
{
    global $container;

    $containerBuilder = new ContainerBuilder();

    $containerBuilder->addDefinitions([
        Rabbit::class => \DI\create(Rabbit::class)->constructor(
            \DI\get(RabbitConnection::class),
        ),
    ]);

    $container = $containerBuilder->build();
}

/**
 * @param string $name
 */
function app(string $name): mixed
{
    global $container;

    // Garante que o container seja inicializado antes do uso.
    if ($container === null) {
        bootstrap();
    }

    $instance = $container->get($name);

    return $instance;
}

bootstrap();
