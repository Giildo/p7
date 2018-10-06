<?php

namespace App\Application\APIs\Phones\All\OutputList;

use App\Application\APIs\Interfaces\OutputItemInterface;
use App\Application\APIs\Phones\All\OutputList\Interfaces\PhoneOutputListInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

class PhonesOutputList implements PhoneOutputListInterface, OutputItemInterface
{
    /**
     * @SWG\Property(
     *     type="array",
     *     @SWG\Items(ref=@Model(type=App\Application\APIs\Phones\All\OutputItems\PhoneOutput::class))
     * )
     *
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
     * @param OutputItemInterface $phone
     *
     * @return void
     */
    public function add(OutputItemInterface $phone): void
    {
        $this->phones[] = $phone;
    }
}
