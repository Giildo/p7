<?php

namespace App\Application\APIs\Users\OutputItems;

use App\Application\APIs\Helpers\Hateoas\Link;
use App\Application\APIs\Users\OutputItems\Interfaces\OutputUsersItemInterface;
use App\Domain\Models\Interfaces\ClientInterface;
use App\Domain\Models\Interfaces\UserInterface;
use Ramsey\Uuid\Uuid;

class UserOutput implements OutputUsersItemInterface
{
    /**
     * @var Uuid
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var array
     */
    private $roles;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var Link[]|array
     */
    private $links;

    /**
     * UserOutput constructor.
     * @param UserInterface $user
     * @param Link[]|array $links
     */
    public function __construct(UserInterface $user, $links)
    {
        $this->id = $user->getId();
        $this->username = $user->getUsername();
        $this->password = $user->getPassword();
        $this->roles = $user->getRoles();
        $this->client = $user->getClient();
        $this->links = $links;
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @return ClientInterface
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * @return Link[]|array
     */
    public function getLinks(): array
    {
        return $this->links;
    }
}
