<?php

namespace App\Application\APIs\Phones\All\InputItems\Interfaces;

use App\Application\APIs\Interfaces\InputInterface;

interface InputPhoneInterface extends InputInterface
{
    /**
     * @return null|string
     */
    public function getCategory(): ?string;
}
