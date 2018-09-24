<?php

namespace App\Application\APIs\Users\All\InputItems;

use App\Application\APIs\Users\All\InputItems\Interfaces\InputUserInterface;

class UserInput implements InputUserInterface
{
    /**
     * @var int|null
     */
    private $limit;
    /**
     * @var int|null
     */
    private $offset;
    /**
     * @var string
     */
    private $clientUsername;

    /**
     * UserInput constructor.
     * @param string $clientUsername
     * @param int|null $limit
     * @param int|null $offset
     */
    public function __construct(
        string $clientUsername,
        ?int $limit = 0,
        ?int $offset = 0
    ) {
        $this->clientUsername = $clientUsername;
        $this->limit = $limit;
        $this->offset = $offset;
    }

    /**
     * @return int|null
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * @return int|null
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * @return string
     */
    public function getClientUsername(): string
    {
        return $this->clientUsername;
    }
}
