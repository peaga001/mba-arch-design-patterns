<?php

declare(strict_types=1);

namespace App\Core\Domain\Enums;

enum PaymentType: string
{
    case ACCRUAL = 'accrual';
    case CASH    = 'cash';
}
