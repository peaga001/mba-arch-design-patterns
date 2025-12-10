<?php

declare(strict_types=1);

namespace App\Application\Presenters;

use App\Application\Interfaces\IGenerateInvoicesPresenter;

class CsvInvoicesPresenter implements IGenerateInvoicesPresenter
{
    /**
     * @param array $output
     * @return string
     */
    public function present(array $output): string
    {
        $content = [];

        $array = $this->outputToArray($output);

        $keys      = array_keys($array[0]);
        $content[] = implode(",", $keys);

        foreach ($array as $line) {
            $content[] = implode(",", $line);
        }

        return implode("\r\n", $content);
    }

    /**
     * @param array $object
     * @return array
     */
    private function outputToArray(array $object): array
    {
        return json_decode(json_encode($object), true);
    }
}
