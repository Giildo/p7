<?php

namespace App\Application\APIs\Phones\OutputItems\Interfaces;

use App\Application\APIs\Interfaces\SubObjectInterface;

interface BrandOutputInterface extends SubObjectInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getName(): string;
}