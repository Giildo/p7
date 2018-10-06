<?php

namespace App\Application\APIs\Users\OutputList\Interfaces;

use App\Application\APIs\Interfaces\OutputListInterface;
use App\Application\APIs\Users\OutputItems\UserOutput;

interface UserOutputListInterface extends OutputListInterface
{
    /**
     * @return UserOutput[]
     */
    public function getUsers(): array;
}
