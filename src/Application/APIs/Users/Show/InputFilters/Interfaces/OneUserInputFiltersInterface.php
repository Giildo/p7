<?php

namespace App\Application\APIs\Users\Show\InputFilters\Interfaces;

use App\Application\APIs\Interfaces\InputFiltersInterface;

interface OneUserInputFiltersInterface extends InputFiltersInterface
{
    /**
     * @return string
     */
    public function getUserId(): string;

    /**
     * @return string
     */
    public function getClientId(): string;
}
