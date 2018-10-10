<?php

namespace App\Domain\Models\Interfaces;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;

interface ClientInterface extends UserInterface
{
    /**
     * @return Uuid
     */
    public function getId(): Uuid;
}
