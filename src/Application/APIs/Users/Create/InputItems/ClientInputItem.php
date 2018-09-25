<?php

namespace App\Application\APIs\Users\Create\InputItems;

use App\Application\APIs\Users\Create\InputItems\Interfaces\ClientInputItemInterface;

class ClientInputItem implements ClientInputItemInterface
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
     * @var array
     */
    private $roles;

    /**
     * ClientInputItem constructor.
     * @param string $id
     * @param string $username
     * @param string $password
     * @param array $roles
     */
    public function __construct(
        string $id,
        string $username,
        string $password,
        array $roles
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->roles = $roles;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string The username
     */
    public function getUsername()
    {
        return $this->username;
    }
}
