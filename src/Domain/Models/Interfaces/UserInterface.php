<?php

namespace App\Domain\Models\Interfaces;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface as SecurityUserInterface;

interface UserInterface extends SecurityUserInterface
{
    /**
     * @return Uuid|null
     */
    public function getId(): ?Uuid;

    /**
     * @return ClientInterface
     */
    public function getClient(): ClientInterface;
}
