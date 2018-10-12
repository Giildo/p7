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
     * @return string
     */
    public function getClientId(): string;

    /**
     * @param string $clientId
     *
     * @return void
     */
    public function addClientId(string $clientId): void;
}
