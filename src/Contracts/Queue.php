<?php

namespace App\Contracts;

interface Queue
{
    public function handle(): void;
}
