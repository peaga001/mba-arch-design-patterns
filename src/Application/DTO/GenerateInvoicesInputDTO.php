<?php

declare(strict_types=1);

namespace App\Application\DTO;

use App\Domain\Enums\PaymentType;

class GenerateInvoicesInputDTO
{
    public function __construct(
        public int $month,
        public int $year,
        public PaymentType $paymentType,
        public ?string $userAgent = null
    ) {
    }

    public static function makeFromArray(array $data): self
    {
        return new self(
            month: (int) $data['month'],
            year: (int) $data['year'],
            paymentType: PaymentType::from($data['payment_type']),
            userAgent: $data['user_agent'] ?? null
        );
    }
}
