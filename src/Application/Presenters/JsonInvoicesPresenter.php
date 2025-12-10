<?php

declare(strict_types=1);

namespace App\Application\Presenters;

use App\Application\Interfaces\IGenerateInvoicesPresenter;

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
