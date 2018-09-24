<?php

namespace App\Application\APIs\Phones\All\OutputList;

use App\Application\APIs\Interfaces\OutputItemInterface;
use App\Application\APIs\Phones\All\OutputList\Interfaces\PhoneOutputListInterface;

class PhonesOutputList implements PhoneOutputListInterface, OutputItemInterface
{
    /**
     * @var OutputItemInterface[]|array
     */
    private $phones = [];

    /**
     * PhonesOutputList constructor.
     * @param array|null $phones
     */
    public function __construct(?array $phones = [])
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

    /**
     * @param OutputItemInterface $outputItem
     *
     * @return void
     */
    public function addOutputItem(OutputItemInterface $outputItem): void
    {
        $this->phones[] = $outputItem;
    }
}
