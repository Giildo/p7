<?php

namespace App\Application\APIs\Phones\All\OutputList\Interfaces;

use App\Application\APIs\Interfaces\OutputItemInterface;
use App\Application\APIs\Interfaces\OutputListInterface;

interface PhoneOutputListInterface extends OutputListInterface
{
    /**
     * @return OutputItemInterface[]|array
     */
    public function getPhones(): array;
}
