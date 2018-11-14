<?php

namespace App\Application\APIs\Users\OutputItems\Interfaces;

use App\Application\APIs\Interfaces\SubObjectInterface;

interface ClientOutputInterface extends SubObjectInterface
{
    /**
     * @return string
     */
    public function getId(): string;

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
}
