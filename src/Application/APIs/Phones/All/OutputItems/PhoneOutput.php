<?php

namespace App\Application\APIs\Phones\All\OutputItems;

use App\Application\APIs\Interfaces\OutputItemInterface;
use Ramsey\Uuid\Uuid;
use Swagger\Annotations as SWG;

class PhoneOutput implements OutputItemInterface
{
    /**
     * @SWG\Property(
     *     type="string"
     * )
     *
     * @var Uuid
     */
    private $id;

    /**
     * @var string
     */
    private $brand;

    /**
     * @var string
     */
    private $os;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string[]
     */
    private $links;

    /**
     * PhoneOutput constructor.
     *
     * @param array $phone
     * @param string[]|array $links
     */
    public function __construct(
        array $phone,
        array $links
    ) {
        $this->id = $phone['id'];
        $this->brand = $phone['brand'];
        $this->os = $phone['os'];
        $this->name = $phone['name'];
        $this->links = $links;
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @return string
     */
    public function getOs(): string
    {
        return $this->os;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string[]
     */
    public function getLinks(): array
    {
        return $this->links;
    }
}
