<?php

namespace App\Application\APIs\Phones\All\InputFilters;

use App\Application\APIs\Phones\All\InputFilters\Interfaces\InputFiltersPhoneInterface;

class PhoneInputFilters implements InputFiltersPhoneInterface
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
     * @var string|null
     */
    private $brand;

    /**
     * PhoneInputFilters constructor.
     * @param int|null $limit
     * @param int|null $offset
     * @param null|string $brand
     */
    public function __construct(
        ?int $limit = 0,
        ?int $offset = 0,
        ?string $brand = ''
    ) {
        $this->limit = $limit;
        $this->offset = $offset;
        $this->brand = $brand;
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
     * @return string|null
     */
    public function getCategory(): ?string
    {
        return $this->brand;
    }
}
