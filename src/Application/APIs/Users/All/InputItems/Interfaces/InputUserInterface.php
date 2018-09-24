<?php

namespace App\Application\APIs\Users\All\InputItems\Interfaces;

use App\Application\APIs\Interfaces\InputInterface;

interface InputUserInterface extends InputInterface
{
    /**
     * @return string
     */
    public function getClientUsername(): string;
}
