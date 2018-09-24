<?php

namespace App\Application\APIs\Users\OutputList\Interfaces;

use App\Application\APIs\Interfaces\OutputItemInterface;
use App\Application\APIs\Interfaces\OutputListInterface;

interface UserOutputListInterface extends OutputListInterface
{
    /**
     * @return OutputItemInterface[]|array
     */
    public function getUsers(): array;
}
