<?php

declare(strict_types=1);

namespace App\Core\Application\Ports;

use App\Core\Application\DTO\GenerateInvoicesInputDTO;

interface IInvoicesManager
{
    public function generateInvoices(
        IGenerateInvoicesPresenter $invoicesPresenter,
        GenerateInvoicesInputDTO $input
    ): mixed;
}
