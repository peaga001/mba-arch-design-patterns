<?php

declare(strict_types=1);

namespace App\Adapters\DB\DBConnections;

interface IDBConnection
{
    public function get(string $table): array;
    public function save(string $table, mixed $values): void;
}
