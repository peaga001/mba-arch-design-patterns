<?php

declare(strict_types=1);

namespace App\Application\Mediators;

class Listener
{
    public string $event;
    public $callback;

    public function __construct(string $event, callable $callback)
    {
        $this->event = $event;
        $this->callback = $callback;
    }

    public function isEvent(string $event): bool
    {
        return $this->event === $event;
    }

    public function callback(mixed $payload): void
    {
        ($this->callback)($payload);
    }
}
