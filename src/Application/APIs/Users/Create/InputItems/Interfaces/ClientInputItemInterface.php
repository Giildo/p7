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
     * @return array
     */
    public function getRoles();

    /**
     * @return string The password
     */
    public function getPassword();
    /**
     * @return string The username
     */
    public function getUsername();
}
