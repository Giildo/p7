<?php

namespace App\Application\APIs\Phones\All\OutputItems;

use App\Application\APIs\Helpers\Hateoas\Interfaces\LinkInterface;
use App\Application\APIs\Phones\All\OutputItems\Interfaces\PhoneOutputInterface;
use App\Application\APIs\Phones\OutputItems\BrandOutput;
use App\Application\APIs\Phones\OutputItems\Interfaces\BrandOutputInterface;
use App\Domain\Models\Interfaces\PhoneInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

class PhoneOutput implements PhoneOutputInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @SWG\Property(
     *     type="array",
     *     @SWG\Items(ref=@Model(type=App\Application\APIs\Phones\OutputItems\BrandOutput::class))
     * )
     *
     * @var BrandOutputInterface
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
        $this->id = $phone->getId()->toString();
        $this->brand = (new BrandOutput())->create($phone->getBrand());
        $this->os = $phone->getOs();
        $this->name = $phone->getName();
        $this->links = $links;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return BrandOutputInterface
     */
    public function getBrand(): BrandOutputInterface
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
