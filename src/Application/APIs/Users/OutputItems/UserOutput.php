<?php

namespace App\Application\APIs\Users\OutputItems;

use App\Application\APIs\Helpers\Hateoas\Interfaces\LinkInterface;
use App\Application\APIs\Users\OutputItems\Interfaces\ClientOutputInterface;
use App\Application\APIs\Users\OutputItems\Interfaces\OutputUsersItemInterface;
use App\Domain\Models\Interfaces\UserInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

class UserOutput implements OutputUsersItemInterface
{
    /**
     * @var string
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
     * @SWG\Property(
     *     type="array",
     *     @SWG\Items(ref=@Model(type=App\Application\APIs\Users\OutputItems\ClientOutput::class))
     * )
     *
     * @var ClientOutputInterface
     */
    private $client;

    /**
     * @SWG\Property(
     *     type="array",
     *     @SWG\Items(ref=@Model(type=App\Application\APIs\Helpers\Hateoas\Link::class))
     * )
     *
     * @var LinkInterface[]
     */
    private $links;

    /**
     * UserOutput constructor.
     * @param UserInterface $user
     * @param LinkInterface[] $links
     */
    public function __construct(UserInterface $user, $links)
    {
        $this->id = $user->getId()->toString();
        $this->username = $user->getUsername();
        $this->password = $user->getPassword();
        $this->roles = $user->getRoles();
        $this->client = (new ClientOutput())->create($user->getClient());
        $this->links = $links;
    }

    /**
     * @return string
     */
    public function getId(): string
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
     * @return ClientOutputInterface
     */
    public function getClient(): ClientOutputInterface
    {
        return $this->client;
    }

    /**
     * @return LinkInterface[]
     */
    public function getLinks(): array
    {
        return $this->links;
    }
}
