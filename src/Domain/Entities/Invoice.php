<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use Carbon\Carbon;

final readonly class Invoice
{
    public function __construct(
        public Carbon $date,
        public int $amount
    ) {
    }
}
