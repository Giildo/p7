<?php

namespace App\Application\APIs\Phones\All\Helpers\Interfaces;

use App\Application\APIs\Interfaces\InputInterface;
use App\Application\APIs\Interfaces\OutputListInterface;

interface LoaderInterface
{
    /**
     * @param InputInterface|null $inputFilters
     *
     * @return OutputListInterface|null
     */
    public function load(?InputInterface $inputFilters = null): ?OutputListInterface;
}
