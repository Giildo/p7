<?php

namespace App\Application\APIs\Users\All\InputFilters;

use App\Application\APIs\Users\All\InputFilters\Interfaces\InputFiltersUserInterface;

class UserInputFilters implements InputFiltersUserInterface
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
    private $clientId;

    /**
     * OneUserInputFilters constructor.
     * @param string $clientId
     * @param int|null $limit
     * @param int|null $offset
     */
    public function __construct(
        string $clientId,
        ?int $limit = 0,
        ?int $offset = 0
    ) {
        $this->clientId = $clientId;
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
    public function getClientId(): string
    {
        return $this->clientId;
    }
}
