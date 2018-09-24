<?php

namespace App\Application\APIs\Users\All\OutputItems;

use App\Application\APIs\Helpers\Hateoas\Link;
use App\Application\APIs\Interfaces\OutputItemInterface;
use App\Domain\Models\Interfaces\ClientInterface;
use App\Domain\Models\User;
use Ramsey\Uuid\Uuid;

class UserOutput implements OutputItemInterface
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
     * @param User $user
     * @param Link[]|array $links
     */
    public function __construct(User $user, $links)
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
    public function getLinks()
    {
        return $this->links;
    }
}
