<?php

declare(strict_types=1);

namespace App\Consumers\Ports;

interface IRequestLogger
{
    public function write(string | array $message): void;
}
