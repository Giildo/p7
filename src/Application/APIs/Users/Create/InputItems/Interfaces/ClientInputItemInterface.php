<?php

namespace App\Application\APIs\Users\Create\InputItems\Interfaces;

use App\Application\APIs\Interfaces\InputItemInterface;

interface ClientInputItemInterface extends InputItemInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string[]
     */
    public function getRoles(): array;

    /**
     * @return string The password
     */
    public function getPassword(): string;
    /**
     * @return string The username
     */
    public function getUsername(): string;
}
