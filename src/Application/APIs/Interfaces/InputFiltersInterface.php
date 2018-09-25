<?php

namespace App\Application\APIs\Interfaces;

interface InputFiltersInterface
{
    /**
     * @return int|null
     */
    public function getLimit(): ?int;

    /**
     * @return int|null
     */
    public function getOffset(): ?int;
}
