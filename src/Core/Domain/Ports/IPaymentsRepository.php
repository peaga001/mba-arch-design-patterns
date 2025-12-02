<?php

declare(strict_types=1);

namespace App\Core\Domain\Ports;

use App\Core\Domain\Entities\Payment;

interface IPaymentsRepository
{
    public function listContractPayments(string $contractId): array;
    public function savePayment(Payment $payment): void;
}
