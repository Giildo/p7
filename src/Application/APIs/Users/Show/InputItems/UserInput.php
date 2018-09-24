<?php

namespace App\Application\APIs\Users\Show\InputItems;

use App\Application\APIs\Users\Show\InputItems\Interfaces\OneUserInputInterface;

class UserInput implements OneUserInputInterface
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
     * UserInput constructor.
     * @param string $id
     * @param string $username
     */
    public function __construct(
        string $id,
        string $username
    ) {
        $this->id = $id;
        $this->username = $username;
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
     * @return int|null
     */
    public function getLimit(): ?int
    {
        return null;
    }

    /**
     * @return int|null
     */
    public function getOffset(): ?int
    {
        return null;
    }
}
