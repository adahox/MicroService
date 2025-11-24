<?php

namespace App\Job;

use App\Contracts\Queue;
use App\Trait\Queue\Queueable;

class UnfollowJob implements Queue
{
    use Queueable;

    /**
     * @param \stdClass $payload
     */
    public function __construct(public \stdClass $payload)
    {
        # do something
    }

    public function handle(): void
    {
        # acessa o instagram
        echo "Unfollow Running...";
    }
}
