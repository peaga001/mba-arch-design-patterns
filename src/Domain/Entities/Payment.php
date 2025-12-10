<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use Carbon\Carbon;

readonly class Payment
{
    public function __construct(
        public string $paymentId,
        public string $contractId,
        public int $amount,
        public Carbon $date
    ) {
    }
}
