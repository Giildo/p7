<?php

namespace App\Application\APIs\Phones\All\InputFilters\Interfaces;

use App\Application\APIs\Interfaces\InputFiltersInterface;

interface InputFiltersPhoneInterface extends InputFiltersInterface
{
    /**
     * @return null|string
     */
    public function getCategory(): ?string;
}
