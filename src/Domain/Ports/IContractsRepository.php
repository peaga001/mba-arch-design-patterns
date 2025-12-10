<?php

declare(strict_types=1);

namespace App\Domain\Ports;

use App\Domain\Entities\Contract;

interface IContractsRepository
{
    /**
     * @return Contract[]
     */
    public function listContracts(): array;

    public function saveContract(Contract $contract): void;
}
