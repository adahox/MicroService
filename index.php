<?php

namespace App;

use App\Jobs\UnfollowJob;
use stdClass;

require "./vendor/autoload.php";
require "bootstrap.php";

$user = new stdClass();
$user->user_id = 10;
$user->email = "Adão Dias";

UnfollowJob::dispatch($user);
