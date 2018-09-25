<?php

namespace App\Application\APIs\Interfaces;

interface LoaderInterface
{
    /**
     * @param InputFiltersInterface|null $inputFilters
     *
     * @return OutputListInterface|null
     */
    public function load(?InputFiltersInterface $inputFilters = null): ?OutputListInterface;
}
