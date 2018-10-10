<?php

namespace App\Application\APIs\Users\OutputItems;

use App\Application\APIs\Interfaces\SubObjectInterface;
use App\Application\APIs\Users\OutputItems\Interfaces\ClientOutputInterface;
use App\Domain\Models\Interfaces\ClientInterface;
use Swagger\Annotations as SWG;

class ClientOutput implements ClientOutputInterface
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
     * @SWG\Property(
     *     type="array",
     *     @SWG\Items(type="string")
     * )
     *
     * @var string[]
     */
    private $roles;

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
     * @param ClientInterface $object
     *
     * @return SubObjectInterface
     */
    public function create($object): SubObjectInterface
    {
        $this->id = $object->getId()->toString();
        $this->username = $object->getUsername();
        $this->password = $object->getPassword();
        $this->roles = $object->getRoles();

        return $this;
    }
}
