<?php

namespace App\Factory;

abstract class MicroServiceFactory
{
    abstract public function run(): void;
}