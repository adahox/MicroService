<?php

namespace App\Facades;

use App\Facades\Facade;
use App\Rabbit\Rabbit as RabbitService;

use function App\app;

class Rabbit extends Facade
{
    public static function getFacadeRoot(): mixed
    {
        return app(RabbitService::class);
    }
}
