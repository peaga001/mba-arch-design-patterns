<?php

declare(strict_types=1);

namespace App\Application\Interfaces;

use App\Application\DTO\GenerateInvoicesInputDTO;

interface IInvoicesManager
{
    public function generateInvoices(
        IGenerateInvoicesPresenter $invoicesPresenter,
        GenerateInvoicesInputDTO $input
    ): mixed;
}
