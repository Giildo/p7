<?php

namespace App\Application\APIs\Users\Show\InputFilters;

use App\Application\APIs\Users\Show\InputFilters\Interfaces\OneUserInputFiltersInterface;

class OneUserInputFilters implements OneUserInputFiltersInterface
{
    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $clientId;

    /**
     * OneUserInputFilters constructor.
     * @param string $userId
     * @param string $clientId
     */
    public function __construct(
        string $userId,
        string $clientId
    ) {
        $this->userId = $userId;
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
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
