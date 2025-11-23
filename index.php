<?php

require './vendor/autoload.php';

use App\MicroService;

class App extends MicroService
{
    public function run(): void
    {
        echo "running app";
    }
}

$app = new App();

$app->run();