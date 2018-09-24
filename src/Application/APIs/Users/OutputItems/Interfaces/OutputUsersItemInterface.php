<?php

namespace App\Application\APIs\Users\OutputItems\Interfaces;

use App\Application\APIs\Helpers\Hateoas\Link;
use App\Application\APIs\Interfaces\OutputItemInterface;
use App\Domain\Models\Interfaces\ClientInterface;
use Ramsey\Uuid\Uuid;

interface OutputUsersItemInterface extends OutputItemInterface
{

    /**
     * @return Uuid
     */
    public function getId(): Uuid;

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
     * @return ClientInterface
     */
    public function getClient(): ClientInterface;

    /**
     * @return Link[]|array
     */
    public function getLinks(): array;
}
