<?php

declare(strict_types=1);

namespace App\Application\Interfaces;

use App\Application\DTO\GenerateInvoicesOutputDTO;

interface IGenerateInvoicesPresenter
{
    /**
     * @param GenerateInvoicesOutputDTO[] $output
     * @return mixed
     */
    public function present(array $output): mixed;
}
