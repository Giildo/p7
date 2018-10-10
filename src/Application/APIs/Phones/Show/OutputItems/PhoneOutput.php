<?php

namespace App\Application\APIs\Phones\Show\OutputItems;

use App\Application\APIs\Helpers\Hateoas\Interfaces\LinkInterface;
use App\Application\APIs\Phones\OutputItems\BrandOutput;
use App\Application\APIs\Phones\OutputItems\Interfaces\BrandOutputInterface;
use App\Application\APIs\Phones\Show\OutputItems\Interfaces\MemoryOutputInterface;
use App\Application\APIs\Phones\Show\OutputItems\Interfaces\PhoneOutputInterface;
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
     * @SWG\Property(
     *     type="array",
     *     @SWG\Items(ref=@Model(type=App\Application\APIs\Phones\Show\OutputItems\MemoryOutput::class))
     * )
     *
     * @var MemoryOutputInterface[]|array
     */
    private $memories;

    /**
     * @var int
     */
    private $ram;

    /**
     * @var int
     */
    private $battery;

    /**
     * @var string
     */
    private $sim;

    /**
     * @var int
     */
    private $screenResolutionH;

    /**
     * @var int
     */
    private $screenResolutionW;

    /**
     * @var float
     */
    private $screen;

    /**
     * @var int
     */
    private $cameraFront;

    /**
     * @var int
     */
    private $cameraBack;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $g4;

    /**
     * @var bool
     */
    private $g5;

    /**
     * @var bool
     */
    private $wifi;

    /**
     * @var bool
     */
    private $removableBattery;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var int
     */
    private $weight;

    /**
     * @var int
     */
    private $thickness;

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
        $this->ram = $phone->getRam();
        $this->battery = $phone->getBattery();
        $this->sim = $phone->getSim();
        $this->screenResolutionH = $phone->getScreenResolutionH();
        $this->screenResolutionW = $phone->getScreenResolutionW();
        $this->screen = $phone->getScreen();
        $this->cameraFront = $phone->getCameraFront();
        $this->cameraBack = $phone->getCameraBack();
        $this->name = $phone->getName();
        $this->g4 = $phone->hasG4();
        $this->g5 = $phone->hasG5();
        $this->wifi = $phone->hasWifi();
        $this->removableBattery = $phone->hasRemovableBattery();
        $this->width = $phone->getWidth();
        $this->height = $phone->getHeight();
        $this->weight = $phone->getWeight();
        $this->thickness = $phone->getThickness();
        $this->links = $links;

        foreach ($phone->getMemories() as $memory) {
            $this->memories[] = (new MemoryOutput())->create($memory);
        }
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
     * @return MemoryOutputInterface[]|array
     */
    public function getMemories(): array
    {
        return $this->memories;
    }

    /**
     * @return int
     */
    public function getRam(): int
    {
        return $this->ram;
    }

    /**
     * @return int
     */
    public function getBattery(): int
    {
        return $this->battery;
    }

    /**
     * @return string
     */
    public function getSim(): string
    {
        return $this->sim;
    }

    /**
     * @return int
     */
    public function getScreenResolutionH(): int
    {
        return $this->screenResolutionH;
    }

    /**
     * @return int
     */
    public function getScreenResolutionW(): int
    {
        return $this->screenResolutionW;
    }

    /**
     * @return float
     */
    public function getScreen(): float
    {
        return $this->screen;
    }

    /**
     * @return int
     */
    public function getCameraFront(): int
    {
        return $this->cameraFront;
    }

    /**
     * @return int
     */
    public function getCameraBack(): int
    {
        return $this->cameraBack;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function hasG4(): bool
    {
        return $this->g4;
    }

    /**
     * @return bool
     */
    public function hasG5(): bool
    {
        return $this->g5;
    }

    /**
     * @return bool
     */
    public function hasWifi(): bool
    {
        return $this->wifi;
    }

    /**
     * @return bool
     */
    public function hasRemovableBattery(): bool
    {
        return $this->removableBattery;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @return int
     */
    public function getThickness(): int
    {
        return $this->thickness;
    }

    /**
     * @return LinkInterface
     */
    public function getLinks(): LinkInterface
    {
        return $this->links;
    }
}
