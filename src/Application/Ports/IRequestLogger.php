<?php

declare(strict_types=1);

namespace App\Application\Ports;

interface IRequestLogger
{
    public function write(string | array $message): void;
}
