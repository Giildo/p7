<?php

namespace App\Application\APIs\Phones\All\OutputItems\Interfaces;

use App\Application\APIs\Helpers\Hateoas\Interfaces\LinkInterface;
use App\Application\APIs\Interfaces\OutputItemInterface;
use App\Application\APIs\Phones\OutputItems\Interfaces\BrandOutputInterface;

interface PhoneOutputInterface extends OutputItemInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return BrandOutputInterface
     */
    public function getBrand(): BrandOutputInterface;

    /**
     * @return string
     */
    public function getOs(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return LinkInterface
     */
    public function getLinks(): LinkInterface;
}
