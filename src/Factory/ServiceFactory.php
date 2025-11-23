<?php

namespace App\Factory;

abstract class ServiceFactory
{
    abstract public function run(): void;
}