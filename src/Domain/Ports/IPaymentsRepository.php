<?php

declare(strict_types=1);

namespace App\Domain\Ports;

use App\Domain\Entities\Payment;

interface IPaymentsRepository
{
    public function listContractPayments(string $contractId): array;
    public function savePayment(Payment $payment): void;
}
