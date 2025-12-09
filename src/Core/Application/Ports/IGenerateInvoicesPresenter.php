<?php

declare(strict_types=1);

namespace App\Core\Application\Ports;

use App\Core\Application\DTO\GenerateInvoicesOutputDTO;

interface IGenerateInvoicesPresenter
{
    /**
     * @param GenerateInvoicesOutputDTO[] $output
     * @return mixed
     */
    public function present(array $output): mixed;
}
