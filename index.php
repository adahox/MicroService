<?php

namespace App;

use App\Job\UnfollowJob;
use stdClass;

require "./vendor/autoload.php";

$user = new stdClass();
$user->user_id = 10;

UnfollowJob::dispatch($user)->onQueue("instagram");
