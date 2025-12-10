<?php

declare(strict_types=1);

namespace App\Adapters\Logger\Loggers;

use App\Consumers\Ports\IRequestLogger;

class InMemoryLogger implements IRequestLogger
{
    public function __construct(
        private array $output = []
    ) {
    }

    public function write(string | array $message): void
    {
        if (is_array($message)) {
            $message = json_encode($message);
        }

        $this->output[] = $message;
    }

    public function getOutput(): array
    {
        return $this->output;
    }

    public function getMessage(int $index): ?string
    {
        return $this->output[$index] ?? null;
    }
}
