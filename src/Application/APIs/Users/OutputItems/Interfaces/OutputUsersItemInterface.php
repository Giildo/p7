<?php

namespace App\Application\APIs\Users\OutputItems\Interfaces;

use App\Application\APIs\Interfaces\OutputItemInterface;

interface OutputUsersItemInterface extends OutputItemInterface
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
     * @return array
     */
    public function getRoles(): array;

    /**
     * @return ClientOutputInterface
     */
    public function getClient(): ClientOutputInterface;
}
