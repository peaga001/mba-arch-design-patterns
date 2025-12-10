<?php

declare(strict_types=1);

namespace App\Application\Mediators;

class UseCasesMediator
{
    /**
     * @param Listener[] $listeners
     */
    public function __construct(
        private array $listeners = []
    ) {
    }

    public function addEventListener(string $event, callable $callback): void
    {
        $this->listeners[] = new Listener($event, $callback);
    }

    public function publish(string $event, mixed $payload): void
    {
        foreach ($this->listeners as $listener) {
            if ($listener->isEvent($event)) {
                $listener->callback($payload);
            }
        }
    }
}
