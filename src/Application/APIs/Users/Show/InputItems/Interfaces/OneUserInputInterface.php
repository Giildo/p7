<?php

namespace App\Application\APIs\Users\Show\InputItems\Interfaces;

use App\Application\APIs\Interfaces\InputInterface;

interface OneUserInputInterface extends InputInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getUsername(): string;
}
