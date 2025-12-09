<?php

declare(strict_types=1);

namespace App\Consumers\Presenters;

use App\Core\Application\Ports\IGenerateInvoicesPresenter;

class JsonInvoicesPresenter implements IGenerateInvoicesPresenter
{
    /**
     * @param array $output
     * @return string
     */
    public function present(array $output): string
    {
        return json_encode($output);
    }
}
