<?php

namespace App\Application\APIs\Phones\All\OutputList;

use App\Application\APIs\Interfaces\OutputItemInterface;
use App\Application\APIs\Interfaces\OutputListInterface;

class PhonesOutputList implements OutputListInterface, OutputItemInterface
{
    /**
     * @var OutputItemInterface[]|array
     */
    private $phones;

    /**
     * PhonesOutputList constructor.
     * @param OutputItemInterface[] $phones
     */
    public function __construct(array $phones)
    {
        $this->phones = $phones;
    }

    /**
     * @return OutputItemInterface[]|array
     */
    public function getPhones(): array
    {
        return $this->phones;
    }
}
