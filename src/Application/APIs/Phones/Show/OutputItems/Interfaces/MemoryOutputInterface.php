<?php

namespace App\Application\APIs\Phones\Show\OutputItems\Interfaces;

use App\Application\APIs\Interfaces\SubObjectInterface;

interface MemoryOutputInterface extends SubObjectInterface
{
    /**
     * @return int
     */
    public function getSize(): int;
}
