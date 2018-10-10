<?php

namespace App\Application\APIs\Phones\All\OutputItems;

use App\Application\APIs\Helpers\Hateoas\Interfaces\LinkInterface;
use App\Application\APIs\Interfaces\OutputItemInterface;
use App\Domain\Models\Interfaces\BrandInterface;
use App\Domain\Models\Interfaces\PhoneInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
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
     * @SWG\Property(
     *     type="array",
     *     @SWG\Items(ref=@Model(type=App\Domain\Models\Brand::class))
     * )
     *
     * @var BrandInterface
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
     * @SWG\Property(
     *     type="array",
     *     @SWG\Items(ref=@Model(type=App\Application\APIs\Helpers\Hateoas\Link::class))
     * )
     *
     * @var LinkInterface
     */
    private $links;

    /**
     * PhoneOutput constructor.
     *
     * @param PhoneInterface $phone
     * @param LinkInterface $links
     */
    public function __construct(
        PhoneInterface $phone,
        LinkInterface $links
    ) {
        $this->id = $phone->getId();
        $this->brand = $phone->getBrand();
        $this->os = $phone->getOs();
        $this->name = $phone->getName();
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
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface
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
     * @return LinkInterface
     */
    public function getLinks(): LinkInterface
    {
        return $this->links;
    }
}
