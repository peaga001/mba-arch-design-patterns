<?php

declare(strict_types=1);

namespace App\Adapters\DB\DBConnections\InMemory;

use App\Adapters\DB\DBConnections\IDBConnection;

class InMemoryConnection implements IDBConnection
{
    public function get(string $table): array
    {
        return MemoryDB::$database[$table] ?? [];
    }

    public function save(string $table, mixed $values): void
    {
        MemoryDB::$database[$table][] = $values;
    }
}
