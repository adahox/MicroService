<?php

namespace App;

require "./vendor/autoload.php";

use App\Rabbit\Rabbit;

# php queue subscribe:UnfollowJob
if ($argc <= 1) {
    throw new \Error("We need to implement o -h here at this case.");
}

[$process, $queueName] = explode(":", $argv[1]);

Rabbit::{$process}($queueName);
