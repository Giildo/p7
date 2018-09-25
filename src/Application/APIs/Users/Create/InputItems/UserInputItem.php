<?php

namespace App\Application\APIs\Users\Create\InputItems;

use App\Application\APIs\Users\Create\InputItems\Interfaces\ClientInputItemInterface;
use App\Application\APIs\Users\Create\InputItems\Interfaces\UserInputItemInterface;

class UserInputItem implements UserInputItemInterface
{
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
     * @var ClientInputItemInterface
     */
    private $client;

    /**
     * UserInputItem constructor.
     * @param string $username
     * @param string $password
     * @param array $roles
     * @param array $client
     */
    public function __construct(string $username, string $password, array $roles, array $client)
    {
        $this->username = $username;
        $this->password = $password;
        $this->roles = $roles;
        $this->client = new ClientInputItem(
            $client['id'],
            $client['username'],
            $client['password'],
            $client['roles']
        );
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
     * @return ClientInputItemInterface
     */
    public function getClient(): ClientInputItemInterface
    {
        return $this->client;
    }
}
