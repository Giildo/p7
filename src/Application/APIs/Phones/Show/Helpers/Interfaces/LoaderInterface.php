<?php

namespace App\Application\APIs\Phones\Show\Helpers\Interfaces;

use App\Application\APIs\Interfaces\OutputItemInterface;

interface LoaderInterface
{
    /**
     * @param string $id
     *
     * @return OutputItemInterface
     */
    public function load(string $id): OutputItemInterface;
}
