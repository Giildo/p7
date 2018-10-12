<?php

namespace App\Application\APIs\Interfaces;

interface SubObjectInterface extends OutputItemInterface
{
    /**
     * @param $object
     *
     * @return SubObjectInterface
     */
    public function create($object): self;
}
