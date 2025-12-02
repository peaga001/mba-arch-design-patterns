<?php

declare(strict_types=1);

namespace App\Adapters\DB\Repositories;

use App\Adapters\DB\Constants\TableConstants;
use App\Adapters\DB\DBConnections\IDBConnection;
use App\Core\Domain\Entities\Payment;
use App\Core\Domain\Ports\IPaymentsRepository;
use Carbon\Carbon;

final readonly class PaymentsRepository implements IPaymentsRepository
{
    public function __construct(
        private IDBConnection $dbConnection
    ) {
    }

    /**
     * @param string $contractId
     * @return Payment[]
     */
    public function listContractPayments(string $contractId): array
    {
        $payments = [];

        $paymentsData         = $this->dbConnection->get(table: TableConstants::PAYMENTS);
        $contractPaymentsData = array_filter(
            array: $paymentsData,
            callback: fn ($paymentData) => $paymentData['id_contract'] === $contractId
        ) ?? [];

        foreach ($contractPaymentsData as $contractPaymentData) {
            $payments[] = new Payment(
                paymentId: $contractPaymentData['id_payment'],
                contractId: $contractPaymentData['id_contract'],
                amount: $contractPaymentData['amount'],
                date: Carbon::make($contractPaymentData['date']),
            );
        }

        return $payments;
    }

    public function savePayment(Payment $payment): void
    {
        $this->dbConnection->save(
            table: TableConstants::PAYMENTS,
            values: [
                'id_payment'  => $payment->paymentId,
                'id_contract' => $payment->contractId,
                'amount'      => $payment->amount,
                'date'        => $payment->date->format('Y-m-dTH:i:s')
            ]
        );
    }
}
