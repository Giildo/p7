<?php

namespace App\Application\APIs\Users\Show\InputFilters\Interfaces;

use App\Application\APIs\Interfaces\InputFiltersInterface;

interface OneUserInputFiltersInterface extends InputFiltersInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getUsername(): string;
}
