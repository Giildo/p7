<?php

namespace App\Application\APIs\Users\OutputItems;

use App\Application\APIs\Users\OutputItems\Interfaces\OutputUsersItemInterface;
use App\Domain\Models\Interfaces\ClientInterface;
use App\Domain\Models\Interfaces\UserInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Ramsey\Uuid\Uuid;
use Swagger\Annotations as SWG;

class UserOutput implements OutputUsersItemInterface
{
    /**
     * @SWG\Property(
     *     type="string"
     * )
     *
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
     * @var string[]
     */
    private $roles;

    /**
     * @SWG\Property(ref=@Model(type=App\Domain\Models\Client::class))
     *
     * @var ClientInterface
     */
    private $client;

    /**
     * @var string[]
     */
    private $links;

    /**
     * UserOutput constructor.
     * @param UserInterface $user
     * @param string[] $links
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
     * @return string[]
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
     * @return string[]
     */
    public function getLinks(): array
    {
        return $this->links;
    }
}
