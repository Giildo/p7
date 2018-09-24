<?php

namespace App\Application\APIs\Interfaces;

interface LoaderInterface
{
    /**
     * @param InputInterface|null $inputFilters
     *
     * @return OutputListInterface|null
     */
    public function load(?InputInterface $inputFilters = null): ?OutputListInterface;
}
