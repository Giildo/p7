<?php

namespace App\Application\APIs\Users\Create\InputItems\Interfaces;

use App\Application\APIs\Interfaces\InputItemInterface;

interface UserInputItemInterface extends InputItemInterface
{
    /**
     * @return string
     */
    public function getUsername(): string;

    /**
     * @return string
     */
    public function getPassword(): string;

    /**
     * @return string[]
     */
    public function getRoles(): array;

    /**
     * @return ClientInputItemInterface
     */
    public function getClient(): ClientInputItemInterface;
}
