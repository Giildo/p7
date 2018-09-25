<?php

namespace App\Application\APIs\Users\All\InputFilters\Interfaces;

use App\Application\APIs\Interfaces\InputFiltersInterface;

interface InputFiltersUserInterface extends InputFiltersInterface
{
    /**
     * @return string
     */
    public function getClientUsername(): string;
}
