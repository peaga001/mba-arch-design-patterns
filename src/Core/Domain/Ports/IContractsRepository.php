<?php

declare(strict_types=1);

namespace App\Core\Domain\Ports;

use App\Core\Domain\Entities\Contract;

interface IContractsRepository
{
    /**
     * @return Contract[]
     */
    public function listContracts(): array;

    public function saveContract(Contract $contract): void;
}
